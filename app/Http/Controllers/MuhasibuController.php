<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Garage;
use App\Models\Route;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MuhasibuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:muhasibu|superadmin');
    }

    public function index(Request $request)
    {
        if (is_null($request->search)) {
            $routes = Route::orderBy('updated_at', 'desc')->paginate(20);
        } else {
            $this->validate($request, [
                'search' => 'string',
            ]);
            $search = $request->search;

            $routes = Route::orderBy('updated_at', 'desc')
                ->where('source', 'LIKE', '%' . $search . '%')
                ->where('destination', 'LIKE', '%' . $search . '%')
                ->orWhereHas('driver',  function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('cargo',  function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('vehicle',  function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('platenumber', 'LIKE', '%' . $search . '%');
                })->paginate(20);
        }

        $cargos = Cargo::whereIn('payment', array('bank', 'office'))
            ->whereDate('updated_at', '>=',  Carbon::now()->subDays(6))
            ->select(DB::raw('DATE(updated_at) as day'), DB::raw('SUM(amount) as price'))
            ->groupBy('day')
            ->orderBy('day', 'ASC')->get();

        $xAxis = [];
        $yAxis  = [];

        // dd(count($cargos));

        foreach ($cargos as $cargo) {
            $day = new DateTime($cargo->day);

            array_push($yAxis, $cargo->price);
            array_push($xAxis, $day->format('l'));
        }

        return view('muhasibu.dashboard')->with('routes', $routes)
            ->with('xAxis',  $xAxis)->with('yAxis', $yAxis);
    }

    public function garage()
    {
        $garage = Garage::orderBy('updated_at', 'desc')->paginate(20);
        return view('muhasibu.garage')->with('garages', $garage);
    }

    public function tool_store(Request $request)
    {
        $this->validate($request, [
            'payment' => 'required|string|max:255|in:paid,unpaid',
            'garage_id' => 'required|numeric|gte:1',
            'amount' => 'required|numeric|gte:1',
        ]);

        $garage = Garage::find($request->garage_id);
        if ($garage) {
            $garage->payment = $request->payment;
            $garage->amount = $request->amount;
            $garage->save();

            Session::flash('message', 'Tool payment  successful confirmed');
        } else {
            Session::flash('message', 'Tool payment unsuccessful confirmed');
        }
        return redirect()->back();
    }

    public function invoice()
    {
        $cargos = Cargo::orderBy('updated_at', 'desc')->paginate(20);
        return view('muhasibu.invoice')->with('cargos', $cargos);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'payment_via' => 'required|string|max:255|in:bank,office',
            'cargo_id' => 'required|numeric|gte:1',
        ]);

        $cargo = Cargo::find($request->cargo_id);
        if ($cargo) {
            $cargo->payment = $request->payment_via;
            $cargo->save();

            Session::flash('message', 'Cargo payment  successful confirmed');
        } else {
            Session::flash('message', 'Cargo payment unsuccessful confirmed');
        }
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'route_id' => 'required|numeric|gte:1',
            'route_price' => 'required|numeric|gte:0',
            'payment_status' => 'required|string|max:50',
        ]);

        $route = Route::find($request->route_id);

        if (!is_null($route) && $route->status != 'delivered') {
            $route->price = $request->route_price;
            $route->status = $request->payment_status;
            $route->save();

            Session::flash('message', 'Route  successful updated');
        } else {
            Session::flash('message', 'Route  unsuccessful updated');
        }
        return redirect()->back();
    }

   
}
