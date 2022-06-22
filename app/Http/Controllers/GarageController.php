<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GarageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:mechanics|superadmin|manager');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tool_name' => 'required|string|max:255',
            'amount' => 'required|numeric|gte:1',
            'tool_condition' => 'required|string|max:255',
            'tool_number' => 'required|string|max:255',
            'tool_condition' => 'required|string|max:255',
        ]);

        if ($request->hasFile('slip')) {
            $this->validate(
                $request,
                ['slip' => 'required|mimes:png,jpeg,jpg,docx,pdf,']
            );
        }

        $garage = Garage::create([
            'tool_name' => $request->tool_name,
            'amount' => $request->amount,
            'condition' => $request->tool_condition,
        ]);

        if ($garage) {
            Session::flash('message', 'Garage Tool successful created');
            return redirect()->back();
        } else {
            Session::flash('message', 'Garage Tool unsuccessful created');
            return redirect()->back();
        }
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'tool_name' => 'required|string|max:255',
            'amount' => 'required|numeric|gte:1',
            'garage_id' => 'required|numeric|gte:1',
            'tool_condition' => 'required|string|max:255',
        ]);

        $garage = Garage::find($request->garage_id);

        if ($garage) {
            $garage->tool_name = $request->tool_name;
            $garage->amount = $request->amount;
            $garage->condition = $request->tool_condition;
            $garage->save();

            Session::flash('message', 'Garage Tool successful updated');
            return redirect()->back();
        } else {
            Session::flash('message', 'Garage Tool unsuccessful updated');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'garage_id' => 'required|numeric',
        ]);

        $garage = Garage::where('id', $request->garage_id)->first();

        if (!is_null($garage)) {
            $garage->delete();

            Session::flash('message', 'Tool deleted successful');
            return redirect()->back();
        } else {
            Session::flash('message', 'Tool  unsuccessful deleted');
            return redirect()->back();
        }
    }
}
