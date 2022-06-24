<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Cargo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:storekeeper|muhasibu|superadmin|manager');
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


        return view('services.cargo')->with('cargos', $cargos);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customername' => 'required|string|max:255',
            'customerphone' => 'required|string|max:255',
            'customeremail' => 'required|email|max:255',
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|gte:0',
        ]);

        $invoice = $this->invoiceNumber();

        $cargo = Cargo::create([
            'customername' => $request->customername,
            'customerphone' => $request->customerphone,
            'customeremail' => $request->customeremail,
            'name'  => $request->name,
            'weight'  => $request->weight,
            'invoice' => $invoice,

        ]);

        if ($cargo) {
            // Mail::to(auth()->user()->email)->queue(new InvoiceMail());
            // Mail::to($request->customeremail)->queue(new InvoiceMail(
            //     $cargo->invoice,
            //     $cargo->created_at,
            //     $cargo->customername,
            //     $cargo->customerphone,
            //     $cargo->customeremail,
            //     $cargo->name,
            //     $cargo->amount,
            //     $cargo->weight,
            // ));

            Session::flash('message', 'Cargo successful created');
            return redirect()->back();
        } else {
            Session::flash('message', 'Cargo unsuccessful created');
            return redirect()->back();
        }
    }

    function invoiceNumber()
    {
        $latest = Cargo::count() + 1;
        $month = date('my', strtotime(Carbon::now()));

        if ($latest < 10) {
            return 'YE-' . $month . '-000' . $latest;
        } else  if ($latest < 100 && $latest >= 10) {
            return 'YE-' . $month . '-00' . $latest;
        } else  if ($latest >= 100 && $latest < 1000) {
            return 'YE-' . $month . '-0' . $latest;
        } else {
            return 'YE-' . $month . '-' . $latest;
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'customername' => 'required|string|max:255',
            'customerphone' => 'required|string|max:255',
            'customeremail' => 'required|email|max:255',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|gte:0',
            'weight' => 'required|numeric|gte:0',
            'cargo_id' => 'required|numeric',
        ]);

        $cargo = Cargo::find($request->cargo_id);


        if (!is_null($cargo)) {
            $cargo->name = $request->name;
            $cargo->amount = $request->amount;
            $cargo->weight = $request->weight;
            $cargo->save();

            Session::flash('message', 'Cargo successful created');
            return redirect()->back();
        } else {
            Session::flash('message', 'Cargo unsuccessful created');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'cargo_id' => 'required|numeric',
        ]);

        $driver = Cargo::where('id', $request->cargo_id)->first();

        if (!is_null($driver)) {
            $driver->delete();

            Session::flash('message', 'Cargo deleted successful');
            return redirect()->back();
        } else {
            Session::flash('message', 'Cargo  unsuccessful deleted');
            return redirect()->back();
        }
    }
}
