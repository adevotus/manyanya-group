<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Expense;
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

    public function index()
    {
        $route = Route::whereDate('created_at', Carbon::today());
        $routes = $route->get();

        $cargos = Route::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->select(DB::raw('DATE(updated_at) as day'), DB::raw('SUM(price) as price'))
            ->groupBy('day')
            ->orderBy('day', 'ASC')->get();

        $xAxis = [];
        $yAxis  = [];


        foreach ($cargos as $cargo) {
            $day = new DateTime($cargo->day);

            array_push($yAxis, $cargo->price);
            array_push($xAxis, $day->format('l'));
        }

        $r_sum = $route->sum(DB::raw('price'));
        $r_count = $route->count();

        $e_sum = Expense::whereDate('created_at', Carbon::today())
            ->sum(DB::raw('amount'));

        $g_sum = Garage::whereDate('created_at', Carbon::today())
            ->sum(DB::raw('amount'));

        //Weekly statistics
        $r_w_sum = Route::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum(DB::raw('price'));

        $e_w_sum = Expense::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum(DB::raw('amount'));

        $g_w_sum = Garage::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum(DB::raw('amount'));

        return view('muhasibu.dashboard')->with('routes', $routes)
            ->with('xAxis',  $xAxis)->with('yAxis', $yAxis)->with('r_sum', $r_sum)->with('r_count', $r_count)
            ->with('e_sum', $e_sum)->with('g_sum', $g_sum)
            ->with('r_w_sum', $r_w_sum)->with('g_w_sum', $g_w_sum)->with('e_w_sum', $e_w_sum);
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
