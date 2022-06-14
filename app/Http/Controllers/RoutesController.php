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
        $this->middleware('role:superadmin|storekeeper|manager');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'source' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'cargo_id' => 'required|numeric|gte:1',
            'vehicle_id' => 'required|numeric|gte:1',
            'driver_id' => 'required|numeric|gte:1',
        ]);

        $cargo = Cargo::find($request->cargo_id);
        $cargo->status = 'assigned';
        $cargo->save();

        $vehicle = Vehicle::find($request->vehicle_id);
        $vehicle->status = 'notavailable';
        $vehicle->save();

        $driver = User::find($request->driver_id);
        $driver->status = false;
        $driver->save();

        $route = Route::create([
            'source' => $request->source,
            'destination' => $request->destination,
            'cargo_id' => $request->cargo_id,
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
        ]);



        if ($route) {
            Session::flash('message', 'Route successful created');
            return redirect()->back();
        } else {
            Session::flash('message', 'Route unsuccessful created');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'source' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'cargo_id' => 'required|numeric|gte:1',
            'vehicle_id' => 'required|numeric|gte:1',
            'driver_id' => 'required|numeric|gte:1',
            'route_id' => 'required|numeric|gte:1',
        ]);

        $route = Route::find($request->route_id);

        if ($route->cargo_id != $request->cargo_id) {
            $cargo = Cargo::find($route->cargo_id);
            $cargo->status = 'pending';
            $cargo->save();

            $cargo = Cargo::find($request->cargo_id);
            $cargo->status = 'assigned';
            $cargo->save();
        }

        if (!is_null($route)) {

            $route->source =  $request->source;
            $route->destination =  $request->destination;
            $route->cargo_id =  $request->cargo_id;
            $route->driver_id =  $request->driver_id;
            $route->vehicle_id =  $request->vehicle_id;

            $route->save();

            Session::flash('message', 'Route successful updated');
            return redirect()->back();
        } else {
            Session::flash('message', 'Route unsuccessful updated');
            return redirect()->back();
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
