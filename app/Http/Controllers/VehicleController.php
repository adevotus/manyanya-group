<?php

namespace App\Http\Controllers;

use App\Models\Activity;
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

        if (!is_null($vehicle)) {
            Activity::create([
                'action' => 'ADD VEHICLE',
                'description' => 'Vehicle ' . $vehicle->name . ' with plate number ' . $vehicle->platenumber . ' was added',
                'user_id' => auth()->user()->id,
            ]);

            FacadesSession::flash('message', 'Vehicle created successful');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'ADD VEHICLE',
                'description' => 'Attempt to create vehicle ' . $request->vehicle_name . ' with plate number ' . $request->plate_no . ' failed',
                'user_id' => auth()->user()->id,
            ]);

            FacadesSession::flash('message', 'Vehicle  unsuccessful created');
        }
    }

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


            Activity::create([
                'action' => 'UPDATE VEHICLE',
                'description' => 'Vehicle ' . $vehicle->name . ' with plate number ' . $vehicle->platenumber . ' was updated',
                'user_id' => auth()->user()->id,
            ]);

            FacadesSession::flash('message', 'Vehicle updated successful');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'UPDATE VEHICLE',
                'description' => 'Attempt to update vehicle ' . $request->vehicle_name . ' with plate number ' . $request->plate_no . ' failed',
                'user_id' => auth()->user()->id,
            ]);


            FacadesSession::flash('message', 'Vehicle  unsuccessful updated');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'vehicle_id' => 'required|numeric',
        ]);
        $vehicle = Vehicle::where('id', $request->vehicle_id)->first();

        if (!is_null($vehicle)) {
            $temp = $vehicle;

            $vehicle->delete();

            Activity::create([
                'action' => 'DELETE VEHICLE',
                'description' => 'Attempt to DELETE vehicle ' . $temp->name . ' with plate number ' . $temp->platenumber . ' was successful',
                'user_id' => auth()->user()->id,
            ]);


            FacadesSession::flash('message', 'Vehicle deleted successful ');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'DELETE VEHICLE',
                'description' => 'Attempt to DELETE vehicle with id' . $request->vehicle_id . ' failed',
                'user_id' => auth()->user()->id,
            ]);


            FacadesSession::flash('message', 'Vehicle  unsuccessful deleted');
            return redirect()->back();
        }
    }
}
