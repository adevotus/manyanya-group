<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Route;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoutesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:superadmin|storekeeper|manager|muhasibu');
    }

    public function routes(Request $request)
    {
        $drivers = User::whereRoleIs('driver')->get();
        $vehicles = Vehicle::get();
        $cargos = Cargo::get();

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

        return view('services.routes')->with('routes', $routes)
            ->with('vehicles', $vehicles)
            ->with('drivers', $drivers)
            ->with('cargos', $cargos);
    }

    public function create()
    {
        $drivers = User::whereRoleIs('driver')->get();
        $vehicles = Vehicle::where('status', 'available')->get();
        $cargos = Cargo::orderBy('created_at', 'desc')->get();

        return view('services.add_route')->with('vehicles', $vehicles)
            ->with('drivers', $drivers)
            ->with('cargos', $cargos);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'route_name' => 'required|string|max:255',
            'departure_date' => 'required|string|max:255',
            'trip' => 'required|string|max:255|in:go,return',
            'fuel' => 'required|numeric|gt:0',
            'cargo_id' => 'required|numeric|gte:1',
            'vehicle_id' => 'required|numeric|gte:1',
            'driver_id' => 'required|numeric|gte:1',
        ]);

        $route = Route::create([
            'route' => $request->route_name,
            'fuel' => $request->fuel,
            'trip' => $request->trip,
            'date' => $request->departure_date,
            'cargo_id' => $request->cargo_id,
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
        ]);

        if ($route) {
            Session::flash('message', 'Route successful created');
            return redirect()->route('routes');
        } else {
            Session::flash('message', 'Route unsuccessful created');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $drivers = User::whereRoleIs('driver')->get();
        $vehicles = Vehicle::where('status', 'available')->get();
        $cargos = Cargo::orderBy('created_at', 'desc')->get();

        $route = Route::where('id', $id)->first();

        return view('services.edit_route')
            ->with('route', $route)
            ->with('vehicles', $vehicles)
            ->with('drivers', $drivers)
            ->with('cargos', $cargos);
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->isA('muhasibu')) {
            $route = Route::find($id);
            $cargo = Cargo::find($route->cargo_id);

            $this->validate($request, [
                'driver_allowance' => 'required|numeric|gte:1',
                'price' => 'required|numeric|gte:1',
                'payment_mode' => 'required|string|in:full,installment',
                'payment_method' => 'required|string|in:cash,bank,agent',
            ]);

            $total = $request->price * $cargo->weight;

            if ($request->payment_mode == 'installment') {
                if (!empty($request->advanced_payment)) {
                    $this->validate($request, [
                        'advanced_payment' => 'required|numeric|gte:1',
                    ]);

                    $route->i_price =  $request->advanced_payment;
                    $route->r_price = $total - $request->advanced_payment;
                }
            }

            $route->mode =  $request->payment_mode;
            $route->payment_method =  $request->payment_method;
            $route->drive_allowance =  $request->driver_allowance;
            $route->price =  $total;
            $route->status = 'approved';
            $route->save();

            $cargo->amount = $request->price;
            $cargo->save();

            Session::flash('message', 'Route successful updated');
            return redirect()->route('routes');
        } else {
            $this->validate($request, [
                'route_name' => 'required|string|max:255',
                'departure_date' => 'required|string|max:255',
                'trip' => 'required|string|max:255|in:go,return',
                'fuel' => 'required|numeric|gt:0|max:255',
                'vehicle_id' => 'required|numeric|gte:1',
                'driver_id' => 'required|numeric|gte:1',
            ]);

            $route = Route::find($id);

            if (!is_null($route)) {
                $route->route =  $request->route_name;
                $route->fuel =  $request->fuel;
                $route->date =  $request->departure_date;
                $route->trip =  $request->trip;
                $route->driver_id =  $request->driver_id;
                $route->vehicle_id =  $request->vehicle_id;

                $route->save();

                Session::flash('message', 'Route successful updated');
                return redirect()->route('routes');
            } else {
                Session::flash('message', 'Route unsuccessful updated');
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'route_id' => 'required|numeric',
        ]);

        $route = Route::where('id', $request->route_id)->first();

        if (!is_null($route)) {
            $route->delete();

            Session::flash('message', 'Route deleted successful');
            return redirect()->back();
        } else {
            Session::flash('message', 'Route  unsuccessful deleted');
            return redirect()->back();
        }
    }
}
