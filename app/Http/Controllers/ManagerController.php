<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Expense;
use App\Models\Garage;
use App\Models\Route;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->take(4)->get();
        $cargos = Cargo::orderBy('created_at', 'desc')->take(4)->get();
        $drivers = User::orderBy('created_at', 'desc')->whereRoleIs('driver')->take(4)->get();
        $tools = Garage::orderBy('created_at', 'desc')->take(4)->get();


        $route = Route::whereDate('created_at', Carbon::today());
        $routes = $route->get();

        $rts = Route::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::MONDAY), Carbon::now()->endOfWeek(Carbon::SUNDAY)])
            ->select(DB::raw('DATE(created_at) as day'), DB::raw('SUM(price) as price'))
            ->groupBy('day')
            ->orderBy('day', 'ASC')->get();


        $xAxis = [];
        $yAxis  = [];


        foreach ($rts as $rt) {
            $day = new DateTime($rt->day);

            array_push($yAxis, $rt->price);
            array_push($xAxis, $day->format('l'));
        }

        $r_sum = $route->sum(DB::raw('price'));
        $r_count = $route->count();

        $e_sum = Expense::whereDate('created_at', Carbon::today())
            ->sum(DB::raw('amount'));

        $g_sum = Garage::whereDate('created_at', Carbon::today())
            ->sum(DB::raw('amount'));

        //Weekly statistics
        $r_w_sum = 0;
        $e_w_sum = 0;
        $g_w_sum = 0;

        $r_w_sum = Route::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::MONDAY), Carbon::now()->endOfWeek(Carbon::SUNDAY)])
            ->sum(DB::raw('price'));


        $e_w_sum = Expense::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::MONDAY), Carbon::now()->endOfWeek(Carbon::SUNDAY)])
            ->sum(DB::raw('amount'));

        $g_w_sum = Garage::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::MONDAY), Carbon::now()->endOfWeek(Carbon::SUNDAY)])
            ->sum(DB::raw('amount'));

        return view('manager.dashboard')->with('routes', $routes)
            ->with('drivers', $drivers)
            ->with('vehicles', $vehicles)
            ->with('garages', $tools)
            ->with('cargos', $cargos)
            ->with('xAxis',  $xAxis)->with('yAxis', $yAxis)->with('r_sum', $r_sum)->with('r_count', $r_count)
            ->with('e_sum', $e_sum)->with('g_sum', $g_sum)
            ->with('r_w_sum', $r_w_sum)->with('g_w_sum', $g_w_sum)->with('e_w_sum', $e_w_sum);
    }

    // Driver
    public function driver(Request $request)
    {
        $drivers = User::whereRoleIs('driver')->orderBy('updated_at', 'desc')->paginate(20);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $drivers = User::orderBy('updated_at', 'desc')->whereRoleIs('driver')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('fname', 'LIKE', '%' . $search . '%')
                        ->orWhere('lname', 'LIKE', '%' . $search . '%')
                        // ->orWhere('status', $search)
                        ->paginate(15);
                } else {
                    $drivers = User::orderBy('updated_at', 'desc')->whereRoleIs('driver')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $drivers = User::orderBy('updated_at', 'desc')->whereRoleIs('driver')
                        ->whereDate('updated_at', $request->date)
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('fname', 'LIKE', '%' . $search . '%')
                        ->orWhere('lname', 'LIKE', '%' . $search . '%')
                        ->paginate(15);
                } else {
                    $drivers = User::orderBy('updated_at', 'desc')->whereRoleIs('driver')
                        ->whereDate('updated_at', $request->date)
                        ->paginate(15);
                }
            }
        } else {
            if (!is_null($request->search)) {
                $this->validate($request, [
                    'search' => 'string',
                ]);

                $search = $request->search;

                $drivers = User::orderBy('updated_at', 'desc')->whereRoleIs('driver')
                    ->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('fname', 'LIKE', '%' . $search . '%')
                    ->orWhere('lname', 'LIKE', '%' . $search . '%')
                    ->paginate(15);
            }
        }


        return view('manager.driver')->with('drivers', $drivers);
    }

    public function license($id)
    {
        $driver = User::where('id', $id)
            ->whereRoleIs('driver')
            ->first();

        return Storage::download($driver->licence);
    }

    public function certificate($id)
    {
        $driver = User::where('id', $id)
            ->whereRoleIs('driver')
            ->first();

        return Storage::download($driver->birth_certifacate);
    }
}
