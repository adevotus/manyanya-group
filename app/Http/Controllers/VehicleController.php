<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:mechanics|superadmin|manager');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'vehicle_name' => 'required|string',
            'registration_no' => 'required|string',
            'plate_no' => 'required|string',
            'vehicle_condition' => 'required|string',
        ]);

        $vehicle = Vehicle::create([
            'name' => $request->vehicle_name,
            'reg_number' => $request->registration_no,
            'platenumber' => $request->plate_no,
            'condition' => $request->vehicle_condition,
        ]);

        if ($vehicle) {
            FacadesSession::flash('message', 'Vehicle created successful');
            return redirect()->back();
        } else {
            FacadesSession::flash('message', 'Vehicle  unsuccessful created');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $this->validate($request, [
            'vehicle_name' => 'required|string',
            'registration_no' => 'required|string',
            'plate_no' => 'required|string',
            'vehicle_condition' => 'required|string',
            'vehicle_id' => 'required|numeric',
        ]);

        $vehicle = Vehicle::find($request->vehicle_id);

        if (!is_null($vehicle)) {
            $vehicle->name = $request->vehicle_name;
            $vehicle->reg_number = $request->registration_no;
            $vehicle->platenumber = $request->plate_no;
            $vehicle->condition = $request->vehicle_condition;
            $vehicle->save();


            FacadesSession::flash('message', 'Vehicle updated successful');
            return redirect()->back();
        } else {
            FacadesSession::flash('message', 'Vehicle  unsuccessful updated');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'vehicle_id' => 'required|numeric',
        ]);
        $vehicle = Vehicle::where('id', $request->vehicle_id)->first();

        if (!is_null($vehicle)) {
            $vehicle->delete();

            FacadesSession::flash('message', 'Vehicle deleted successful');
            return redirect()->back();
        } else {
            FacadesSession::flash('message', 'Vehicle  unsuccessful deleted');
            return redirect()->back();
        }
    }
}
