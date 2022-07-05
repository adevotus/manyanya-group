<?php

namespace App\Http\Controllers;

use App\Exports\RouteExport;
use App\Mail\RemainderInvoice;
use App\Models\Cargo;
use App\Models\Payment;
use App\Models\Route;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Excel;
use Illuminate\Support\Facades\Mail;

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

        $routes = Route::orderBy('date', 'desc')->paginate(20);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $routes = Route::orderBy('date', 'desc')
                        ->where('route', 'LIKE', '%' . $search . '%')
                        ->orWhere('trip', 'LIKE', '%' . $search . '%')
                        ->orWhere('mode', 'LIKE', '%' . $search . '%')
                        ->orWhere('payment_method', 'LIKE', '%' . $search . '%')
                        ->orWhere(function ($querys) use ($search) {
                            return  $querys->whereHas('driver', function ($query) use ($search) {
                                return $query->where('name', 'LIKE', '%' . $search . '%');
                            })->orWhereHas('vehicle', function ($query) use ($search) {
                                return $query->where('name', 'LIKE', '%' . $search . '%');
                            })->orWhereHas('cargo', function ($query) use ($search) {
                                return $query->where('name', 'LIKE', '%' . $search . '%');
                            });
                        })
                        ->whereBetween('date', array($fromdate, $toDate))
                        ->paginate(15);
                } else {
                    $routes = Route::orderBy('date', 'desc')
                        ->whereBetween('date', array($fromdate, $toDate))
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $routes = Route::orderBy('date', 'desc')
                        ->where('route', 'LIKE', '%' . $search . '%')
                        ->orWhere('trip', 'LIKE', '%' . $search . '%')
                        ->orWhere('mode', 'LIKE', '%' . $search . '%')
                        ->orWhere('payment_method', 'LIKE', '%' . $search . '%')
                        ->orWhere(function ($querys) use ($search) {
                            return  $querys->whereHas('driver', function ($query) use ($search) {
                                return $query->where('name', 'LIKE', '%' . $search . '%');
                            })->orWhereHas('vehicle', function ($query) use ($search) {
                                return $query->where('name', 'LIKE', '%' . $search . '%');
                            })->orWhereHas('cargo', function ($query) use ($search) {
                                return $query->where('name', 'LIKE', '%' . $search . '%');
                            });
                        })
                        ->whereDate('date', $request->date)
                        ->paginate(15);
                } else {
                    $routes = Route::orderBy('date', 'desc')
                        ->whereDate('date', $request->date)
                        ->paginate(15);
                }
            }
        } else {
            if (!is_null($request->search)) {
                $this->validate($request, [
                    'search' => 'string',
                ]);

                $search = $request->search;

                $routes = Route::orderBy('date', 'desc')
                    ->where('route', 'LIKE', '%' . $search . '%')
                    ->orWhere('trip', 'LIKE', '%' . $search . '%')
                    ->orWhere('mode', 'LIKE', '%' . $search . '%')
                    ->orWhere('payment_method', 'LIKE', '%' . $search . '%')
                    ->orWhere(function ($querys) use ($search) {
                        return  $querys->whereHas('driver', function ($query) use ($search) {
                            return $query->where('name', 'LIKE', '%' . $search . '%');
                        })->orWhereHas('vehicle', function ($query) use ($search) {
                            return $query->where('name', 'LIKE', '%' . $search . '%');
                        })->orWhereHas('cargo', function ($query) use ($search) {
                            return $query->where('name', 'LIKE', '%' . $search . '%');
                        });
                    })
                    ->paginate(15);
            }
        }

        $total = 0;
        foreach ($routes as $exp) {
            $total += $exp->price;
        }

        return view('services.routes')->with('routes', $routes)
            ->with('total', $total)
            ->with('vehicles', $vehicles)
            ->with('drivers', $drivers)
            ->with('cargos', $cargos);
    }

    public function downloadCSV(Request $request)
    {
        return Excel::download(new RouteExport($request->search, $request->date), 'Routes-' . Carbon::now()->format('Y-m-d') . '.csv');
    }

    public function downloadExcel(Request $request)
    {
        return Excel::download(new RouteExport($request->search, $request->date), 'Routes-' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }

    public function downloadPDF(Request $request)
    {
        return Excel::download(new RouteExport($request->search, $request->date), 'Routes-' . Carbon::now()->format('Y-m-d') . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
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

    public function show($id)
    {
        $route = Route::where('id', $id)->first();

        return view('services.show')->with('route', $route);
    }

    public function sendMail($id, Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string'
        ]);

        $route = Route::where('id', $id)->first();

        try {
            Mail::to($route->cargo->customeremail)->send(new RemainderInvoice($request->message));

            Session::flash('message', 'Remainder message was successful sent');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('message', 'Remainder message was unsuccessful sent');
            return redirect()->back();
        }
    }

    public function print($id)
    {
        $route = Route::where('id', $id)->first();

        return view('services.print')->with('route', $route);
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
            $payment = Payment::where('route_id', $route->id)->orderBy('created_at', 'desc')->first();

            $this->validate($request, [
                'driver_allowance' => 'required|numeric|gte:1',
                'price' => 'required|numeric|gte:1',
                'payment_mode' => 'required|string|in:full,installment',
                'payment_method' => 'required|string|in:cash,bank,agent',
            ]);

            $total = $request->price * $cargo->weight;

            if ($request->payment_mode == 'installment') {
                if (!empty($request->advanced_payment)) {
                    if (is_null($payment)) {
                        $this->validate($request, [
                            'advanced_payment' => 'required|numeric|lte:' . $total,
                        ]);
                    } else {
                        $this->validate($request, [
                            'advanced_payment' => 'required|numeric|lte:' . $payment->remaining,
                        ]);
                    }

                    $i_price =  $request->advanced_payment;
                    $r_price = $total - $request->advanced_payment;
                }
            }

            $route->mode =  $request->payment_mode;
            $route->drive_allowance =  $request->driver_allowance;
            $route->price =  $total;
            $route->status = 'approved';
            $route->save();

            $cargo->amount = $request->price;
            $cargo->save();

            // $route = Route::where('id',$id)->first();



            if (is_null($payment)) {
                if ($request->payment_mode == 'installment') {
                    Payment::create([
                        'description' => 'Advanced Installment',
                        'payment_method' =>  $request->payment_method,
                        'price' => $route->price,
                        'installed' => $i_price,
                        'remaining' =>  $r_price,
                        'route_id' =>  $route->id,
                    ]);
                } else {
                    Payment::create([
                        'payment_method' =>  $request->payment_method,
                        'price' => $route->price,
                        'installed' =>  0,
                        'remaining' =>  0,
                        'route_id' =>  $route->id,
                    ]);
                }
            } else {
                if ($request->payment_mode == 'installment') {
                    $count = Payment::where('route_id', $route->id)->count();
                    if ($payment->remaining > 0 && $request->advanced_payment > 0) {
                        Payment::create([
                            'description' => (1 + $count) . ' Installment',
                            'payment_method' =>  $request->payment_method,
                            'price' => $route->price,
                            'installed' => $i_price,
                            'remaining' =>  $payment->remaining - $i_price,
                            'route_id' =>  $route->id,
                        ]);
                    } else {
                        Session::flash('message', 'No changes were made!');
                        return redirect()->route('routes');
                    }
                }
            }

            Session::flash('message', 'Route successful updated');
            return redirect()->route('routes');
        } else {
            $this->validate($request, [
                'route_name' => 'required|string|max:255',
                'departure_date' => 'required|string|max:255',
                'trip' => 'required|string|max:255|in:go,return',
                'fuel' => 'required|numeric|gt:0',
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
