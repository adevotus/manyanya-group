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

    public function index(Request $request)
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

        return view('services.vehicle')->with('vehicles', $vehicle);
    }

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

            FacadesSession::flash('message', 'Vehicle deleted successful ');
            return redirect()->back();
        } else {
            FacadesSession::flash('message', 'Vehicle  unsuccessful deleted');
            return redirect()->back();
        }
    }
}
