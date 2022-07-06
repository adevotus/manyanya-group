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
    public function index(Request $request)
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


        // Monthly Records
        $rAxis = [];
        $sAxis = [];

        if (strlen($request->date) > 16) {
            $fromdate = substr($request->date, 0, -14);
            $toDate =  substr($request->date, -10);

            // dd($request->date);

            $m_r_sum = Route::whereBetween('created_at', [$fromdate, $toDate])
                ->select(DB::raw('DATE(created_at) as day'), DB::raw('SUM(price) as price'))
                ->groupBy('day')
                ->orderBy('day', 'ASC')->get();
        } else {
            $m_r_sum = Route::where('created_at', '>=', Carbon::now()->startOfMonth()->toDateString())
                ->select(DB::raw('DATE(created_at) as day'), DB::raw('SUM(price) as price'))
                ->groupBy('day')
                ->orderBy('day', 'ASC')->get();
        }

        $m_total = 0;

        foreach ($m_r_sum as $mrs) {
            $m_total += ($mrs->price = (is_numeric($mrs->price) || !is_null($mrs->price)) ? $mrs->price : 0);
            $day = new DateTime($mrs->day);

            array_push($sAxis, $mrs->day);
            array_push($rAxis, $mrs->price);
        }


        // Yearly Comparisons
        $today = today();
        $year = Carbon::createFromDate($today->year, $today->month, 1)->format('Y');

        $from = ($year - 1) . '-01-01';
        $from2 = ($year - 1) . '-12-31';

        $to = ($year) . '-01-01';
        $to2 = ($year) . '-12-31';

        $fromY = $year - 1;
        $fromT = $year;

        if ($request->yearFrom != '' && $request->yearTo != '') {
            $from = ($request->yearFrom) . '-01-01';
            $from2 = ($request->yearFrom) . '-12-31';

            $to = ($request->yearTo) . '-01-01';
            $to2 = ($request->yearTo) . '-12-31';

            $fromY = $request->yearFrom;
            $fromT = $request->yearTo;
        }

        $last_year_payments = Route::whereDate('date', '>=', $from)
            ->whereDate('date', '<=', $from2)
            ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM(price) as total'))
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        $this_year_payments = Route::whereDate('date', '>=', $to)
            ->whereDate('date', '<=', $to2)
            ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM(price) as total'))
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        // unset($this->zAxis);
        // unset($this->yAxis);
        $aAxis = array();
        $bAxis = array();

        $y_total = 0;
        $l_total = 0;

        foreach ($this_year_payments as $payment) {
            $y_total += ($payment->total = (is_numeric($payment->total) || !is_null($payment->total)) ? $payment->total : 0);
            array_push($aAxis, $payment->total);
        }

        foreach ($last_year_payments as $payment) {
            $l_total += ($payment->total = (is_numeric($payment->total) || !is_null($payment->total)) ? $payment->total : 0);
            array_push($bAxis, $payment->total);
        }

        return view('manager.dashboard')->with('routes', $routes)
            ->with('drivers', $drivers)
            ->with('vehicles', $vehicles)
            ->with('garages', $tools)
            ->with('cargos', $cargos)
            ->with('aAxis',  $aAxis)->with('bAxis', $bAxis)
            ->with('y_total', $y_total)->with('l_total', $l_total)
            ->with('fromY', $fromY)->with('fromT', $fromT)
            ->with('xAxis',  $xAxis)->with('yAxis', $yAxis)
            ->with('rAxis',  $rAxis)->with('sAxis', $sAxis)->with('counts_month', count($sAxis))
            ->with('r_sum', $r_sum)->with('r_count', $r_count)
            ->with('e_sum', $e_sum)->with('g_sum', $g_sum)
            ->with('m_total', $m_total)
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
