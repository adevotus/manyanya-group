<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Garage;
use App\Models\Route;
use App\Models\User;
use App\Models\Vehicle;
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
        $routes = Route::orderBy('updated_at', 'desc')->get()->take(4);
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get()->take(4);
        $cargos = Cargo::orderBy('created_at', 'desc')->get()->take(4);
        $drivers = User::orderBy('created_at', 'desc')->whereRoleIs('driver')->get()->take(4);
        $tools = Garage::orderBy('created_at', 'desc')->get()->take(4);

        $route = Route::count();
        $vehicle = Vehicle::count();
        $driver = User::whereRoleIs('driver')->count();
        $cargo = Cargo::count();

        return view('manager.dashboard')
            ->with('driver', $driver)
            ->with('route', $route)
            ->with('vehicle', $vehicle)
            ->with('cargo', $cargo)
            ->with('drivers', $drivers)
            ->with('routes', $routes)
            ->with('vehicles', $vehicles)
            ->with('garages', $tools)
            ->with('cargos', $cargos);
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

        return view('manager.vehicle')->with('vehicles', $vehicle);
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

        return view('manager.garage')->with('garages', $garage);
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

    // cargo
    public function cargos(Request $request)
    {
        $cargos = Cargo::orderBy('updated_at', 'desc')->paginate(20);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $cargos = Cargo::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->where('name', 'LIKE', '%' . $search . '%')
                        // ->orWhere('status', $search)
                        ->paginate(15);
                } else {
                    $cargos = Cargo::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $cargos = Cargo::orderBy('updated_at', 'desc')
                        ->whereDate('updated_at', $request->date)
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->paginate(15);
                } else {
                    $cargos = Cargo::orderBy('updated_at', 'desc')
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

                $cargos = Cargo::orderBy('updated_at', 'desc')
                    ->where('name', 'LIKE', '%' . $search . '%')
                    ->paginate(15);
            }
        }


        return view('manager.cargo')->with('cargos', $cargos);
    }

    public function routes(Request $request)
    {
        $drivers = User::whereRoleIs('driver')->where('verified', true)->where('status', true)->get();
        $vehicles = Vehicle::where('status', 'available')->get();
        $cargos = Cargo::where('status', 'pending')->get();

        // dd(strlen($request->date)); //max - 24 min - 10
        // dd(substr($request->date, 0, -14), substr($request->date, -10));

        $routes = Route::orderBy('updated_at', 'desc')->paginate(20);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $routes = Route::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->where('source', 'LIKE', '%' . $search . '%')
                        ->orWhere('destination', 'LIKE', '%' . $search . '%')
                        ->orWhere('status', $search)
                        ->orWhereHas('driver', function ($query) use ($search) {
                            return $query->where('name', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('vehicle', function ($query) use ($search) {
                            return $query->where('name', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('cargo', function ($query) use ($search) {
                            return $query->where('name', 'LIKE', '%' . $search . '%');
                        })
                        ->paginate(15);
                } else {
                    $routes = Route::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $routes = Route::orderBy('updated_at', 'desc')
                        ->whereDate('updated_at', $request->date)
                        ->where('source', 'LIKE', '%' . $search . '%')
                        ->orWhere('destination', 'LIKE', '%' . $search . '%')
                        ->orWhere('status', $search)
                        ->orWhereHas('driver', function ($query) use ($search) {
                            return $query->where('name', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('vehicle', function ($query) use ($search) {
                            return $query->where('name', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhereHas('cargo', function ($query) use ($search) {
                            return $query->where('name', 'LIKE', '%' . $search . '%');
                        })
                        ->paginate(15);
                } else {
                    $routes = Route::orderBy('updated_at', 'desc')
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

                $routes = Route::orderBy('updated_at', 'desc')
                    ->where('source', 'LIKE', '%' . $search . '%')
                    ->orWhere('destination', 'LIKE', '%' . $search . '%')
                    ->orWhere('status', $search)
                    ->orWhereHas('driver', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('vehicle', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('cargo', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->paginate(15);
            }
        }

        return view('manager.routes')->with('routes', $routes)
            ->with('vehicles', $vehicles)
            ->with('drivers', $drivers)
            ->with('cargos', $cargos);
    }
}
