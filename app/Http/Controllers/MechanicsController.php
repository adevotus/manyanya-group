<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Garage;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MechanicsController extends Controller
{
    public function index()
    {
        return view('mechanics.home');
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
