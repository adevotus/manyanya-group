<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class GarageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:mechanics|storekeeper|muhasibu|superadmin|manager');
    }

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

        return view('services.garage')->with('garages', $garage);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tool_name' => 'required|string|max:255',
            'amount' => 'required|numeric|gte:1',
            'tool_condition' => 'required|string|max:255',
            'tool_number' => 'required|string|max:255',
        ]);

        if ($request->hasFile('payment_slip')) {
            $this->validate($request, [
                'payment_slip' => 'required|mimes:png,jpeg,jpg,docx,pdf,docs|max:1000',
            ]);

            $file = $request->file('payment_slip');

            $path = Storage::putFileAs(
                'public/garage/' . $request->email,
                $file,
                'tools' . '-' . $request->tool_name . '-' . time() . '.' . $file->getClientOriginalExtension(),
            );

            $garage = Garage::create([
                'tool_name' => $request->tool_name,
                'amount' => $request->amount,
                'condition' => $request->tool_condition,
                'slip' => $path,
                'tool_no' => $request->tool_number,
            ]);
        } else {
            $garage = Garage::create([
                'tool_name' => $request->tool_name,
                'amount' => $request->amount,
                'condition' => $request->tool_condition,
                'tool_no' => $request->tool_number,
            ]);
        }

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

            if ($request->hasFile('payment_slip')) {
                $this->validate($request, [
                    'payment_slip' => 'required|mimes:png,jpeg,jpg,docx,pdf,docs|max:1000',
                ]);

                $file = $request->file('payment_slip');

                $path = Storage::putFileAs(
                    'public/garage/' . $request->email,
                    $file,
                    'tools' . '-' . $request->tool_name . '-' . time() . '.' . $file->getClientOriginalExtension(),
                );

                $garage->slip = $path;
            }

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
