<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Expense;
use App\Models\Garage;
use App\Models\Route;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MechanicsController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get()->take(4);
        $tools = Garage::orderBy('created_at', 'desc')->get()->take(4);

        $vehicle = Vehicle::count();
        $tool = Garage::count();

        return view('mechanics.home')
            ->with('vehicle', $vehicle)
            ->with('vehicles', $vehicles)
            ->with('garages', $tools)
            ->with('tool', $tool);
    }

    public function ack()
    {
        $route = Route::orderBy('updated_at', 'desc')->paginate(20);

        return view('mechanics.ack')->with('routes', $route);
    }

    public function updateVehicle(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required|string'
        ]);

        $route = Route::find($id);
        if (!is_null($route)) {
            $route->vehicle_description = $request->description;
            $route->save();

            Session::flash('message', 'Vehicle description successful updated');
            return redirect()->back();
        } else {
            Session::flash('message', 'Vehicle description unsuccessful updated');
            return redirect()->back();
        }
    }

    // Expenses
    public function expense(Request $request)
    {
        $expenses = Expense::orderBy('updated_at', 'desc')->paginate(20);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $expenses = Expense::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('platenumber', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('condition', $search)
                        ->paginate(15);
                } else {
                    $expenses = Expense::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $expenses = Expense::orderBy('updated_at', 'desc')
                        ->whereDate('updated_at', $request->date)
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('platenumber', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('condition', $search)
                        ->paginate(15);
                } else {
                    $expenses = Expense::orderBy('updated_at', 'desc')
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

                $expenses = Expense::orderBy('updated_at', 'desc')
                    ->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('platenumber', 'LIKE', '%' . $search . '%')
                    ->orWhere('reg_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('condition', $search)
                    ->paginate(15);
            }
        }

        return view('mechanics.expense')->with('expenses', $expenses);
    }

    // Vehicle
    public function vehicle(Request $request)
    {
        $vehicle = Vehicle::orderBy('updated_at', 'desc')->paginate(20);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $vehicle = Vehicle::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('platenumber', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('condition', $search)
                        ->paginate(15);
                } else {
                    $vehicle = Vehicle::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $vehicle = Vehicle::orderBy('updated_at', 'desc')
                        ->whereDate('updated_at', $request->date)
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('platenumber', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('condition', $search)
                        ->paginate(15);
                } else {
                    $vehicle = Vehicle::orderBy('updated_at', 'desc')
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

                $vehicle = Vehicle::orderBy('updated_at', 'desc')
                    ->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('platenumber', 'LIKE', '%' . $search . '%')
                    ->orWhere('reg_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('condition', $search)
                    ->paginate(15);
            }
        }

        return view('mechanics.vehicle')->with('vehicles', $vehicle);
    }

    // Vehicle Garage
    public function garages(Request $request)
    {
        $garage = Garage::orderBy('updated_at', 'desc')->paginate(20);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $garage = Garage::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->where('tool_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('condition', $search)
                        ->paginate(15);
                } else {
                    $garage = Garage::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $garage = Garage::orderBy('updated_at', 'desc')
                        ->whereDate('updated_at', $request->date)
                        ->where('tool_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('condition', $search)
                        ->paginate(15);
                } else {
                    $garage = Garage::orderBy('updated_at', 'desc')
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

                $garage = Garage::orderBy('updated_at', 'desc')
                    ->where('tool_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('condition', $search)
                    ->paginate(15);
            }
        }

        return view('mechanics.garage')->with('garages', $garage);
    }
}
