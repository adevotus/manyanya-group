<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Expense;
use App\Models\Route;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:driver|superadmin|storekeeper|manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $routeModel = Route::where('driver_id', auth()->user()->id)->orderBy('updated_at', 'desc');

        if (!is_null($request->search)) {
            $this->validate($request, [
                'search' => 'string',
            ]);
            $search = $request->search;

            $routes = $routeModel->where(function ($query) use ($search) {
                return $query->where('source', 'LIKE', '%' . $search . '%')
                    ->orWhere('destination', 'LIKE', '%' . $search . '%')
                    ->orWhere('status', $search)
                    ->orWhereHas('vehicle', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('cargo', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    });
            });
        }



        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $routes = $routeModel->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);

                    $route = $routeModel->whereBetween('updated_at', [$fromdate, $toDate])
                        ->get();
                } else {
                    $routes = $routeModel
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);

                    $route = $routeModel
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->get();
                }
            } else {

                if (!is_null($request->search)) {
                    $routes = $routeModel
                        ->whereDate('updated_at', $request->date)
                        ->paginate(15);

                    $route = $routeModel
                        ->whereDate('updated_at', $request->date)
                        ->get();
                } else {
                    $routes = $routeModel
                        ->whereDate('updated_at', $request->date)
                        ->paginate(15);

                    $route = $routeModel
                        ->whereDate('updated_at', $request->date)
                        ->get();
                }
            }
        } else {
            if (!is_null($request->search)) {
                $routes = $routeModel->paginate(15);
                $route = $routeModel->get();
            } else {
                $routes = $routeModel->paginate(15);
                $route = $routeModel->get();
            }
        }

        $total_price = 0;
        foreach ($route as  $rt) {
            $total_price += $rt->drive_allowance;
        }


        return view('driver.dashboard')->with('routes', $routes)->with('price', $total_price);
    }

    public function ack()
    {
        $route = Route::orderBy('updated_at', 'desc')->where('driver_id', auth()->user()->id)->paginate(20);

        return view('driver.ack')->with('routes', $route);
    }

    public function updateVehicle(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required|string'
        ]);

        $route = Route::find($id);
        if (!is_null($route)) {
            $route->vehicle_description = $request->description;
            $route->save();

            Activity::create([
                'action' => 'UPDATE ROUTE VEHICLE DESCRIPTION',
                'description' => 'Vehicle ' . $route->vehicle->name . ' with plate number ' . $route->vehicle->platenumber . ' route description is updated',
                'user_id' => 4,
            ]);

            Session::flash('message', 'Vehicle description successful updated');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'UPDATE ROUTE VEHICLE DESCRIPTION',
                'description' => 'Route was ' . $id . ' not found',
                'user_id' => 4,
            ]);
            Session::flash('message', 'Vehicle description unsuccessful updated');
            return redirect()->back();
        }
    }

    public function profile()
    {
        return view('driver.register');
    }

    public function registration(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'license' => 'required|max:10000|mimes:doc,docx,pdf,jpg,jpeg,png',
            'certificate' => 'required|max:10000|mimes:doc,docx,pdf,jpg,jpeg,png',
        ]);


        if ($request->hasFile('certificate') && $request->hasFile('license')) {
            $file = $request->file('license');
            $file2 = $request->file('certificate');

            $path = Storage::putFileAs(
                'public/drivers/' . $request->email,
                $file,
                'license' . '-' . $request->email . '-' . time() . '.' . $file->getClientOriginalExtension(),
            );

            $path2 = Storage::putFileAs(
                'public/drivers/' . $request->email,
                $file2,
                'certificate' . '-' . $request->email . '-' . time() . '.' . $file2->getClientOriginalExtension(),
            );

            $user = User::find(auth()->user()->id);


            if (!is_null($user)) {
                $user->update([
                    'fname' => $request->first_name,
                    'lname' => $request->last_name,
                    'phone' => $request->phone_number,
                    'licence' => $path,
                    'birth_certifacate' => $path2,
                ]);

                Activity::create([
                    'action' => 'ADD DRIVER',
                    'description' => 'Driver ' . $user->name . ' with email ' . $user->email . ' was updated successful',
                    'user_id' => auth()->user()->id,
                ]);

                Session::flash('message', 'Driver details successful updated');
                return redirect()->back();
            } else {
                Activity::create([
                    'action' => 'UPDATE DRIVER',
                    'description' => 'Driver was not found',
                    'user_id' => auth()->user()->id,
                ]);

                Session::flash('message', 'Driver details unsuccessful updated');
                return redirect()->back();
            }
        }
    }

    public function route_confirmation(Request $request)
    {
        $this->validate($request, [
            'cargo_delivered' => 'required|string|max:10|in:yes,no',
            'driver_status' => 'required|string|max:10|in:yes,no',
            'route_id' => 'required|numeric|gte:1',
        ]);

        $route = Route::where('id', $request->route_id)->where(function ($query) {
            return $query->where('driver_id', auth()->user()->id);
        })->first();

        if (!is_null($route)) {

            $route->update([
                'status' => 'delivered',
            ]);

            Activity::create([
                'action' => 'UPDATE ROUTE STATUS',
                'description' => 'Route status for route ' . $route->route . ' was updated successful',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Route successful updated');
        } else {
            Activity::create([
                'action' => 'UPDATE ROUTE STATUS',
                'description' => 'Route' . $request->route_id . 'for given driver was not found',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Unsuccessful updated, route with given driver not found');
        }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'verified' => ['required', 'string', 'in:yes,no'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'license' => 'required|max:10000|mimes:doc,docx,pdf,jpg,jpeg,png',
            'certificate' => 'required|max:10000|mimes:doc,docx,pdf,jpg,jpeg,png',
        ]);


        if ($request->hasFile('certificate') && $request->hasFile('license')) {
            $file = $request->file('license');
            $file2 = $request->file('certificate');

            $path = Storage::putFileAs(
                'public/drivers/' . $request->email,
                $file,
                'license' . '-' . $request->email . '-' . time() . '.' . $file->getClientOriginalExtension(),
            );

            $path2 = Storage::putFileAs(
                'public/drivers/' . $request->email,
                $file2,
                'certificate' . '-' . $request->email . '-' . time() . '.' . $file2->getClientOriginalExtension(),
            );

            $user =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'fname' => $request->first_name,
                'lname' => $request->last_name,
                'phone' => $request->phone_number,
                'password' => bcrypt($request->password),
                'licence' => $path,
                'verified' => $request->verified == 'yes' ? true : false,
                'birth_certifacate' => $path2,
            ]);

            $user->attachRole('driver');

            if ($user) {
                Activity::create([
                    'action' => 'ADD DRIVER',
                    'description' => 'Driver ' . $user->name . ' with email ' . $user->email . ' was creaed successful',
                    'user_id' => auth()->user()->id,
                ]);

                Session::flash('message', 'Driver successful created');
                return redirect()->back();
            } else {
                Activity::create([
                    'action' => 'ADD DRIVER',
                    'description' => 'Driver was  unsuccessful created',
                    'user_id' => auth()->user()->id,
                ]);

                Session::flash('message', 'Driver unsuccessful created');
                return redirect()->back();
            }
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'driver_id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'verified' => ['required', 'string', 'in:yes,no'],
        ]);


        $user = User::find($request->driver_id);

        if ($user->email != $request->email) {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);

            $user->email = $request->email;
        }

        if ($request->hasFile('license')) {
            $this->validate($request, [
                'license' => 'max:10000|mimes:doc,docx,pdf,jpg,jpeg,png',
            ]);

            $file = $request->file('license');

            $path = Storage::putFileAs(
                'public/drivers/' . $request->email,
                $file,
                'license' . '-' . $request->email . '-' . time() . '.' . $file->getClientOriginalExtension(),
            );

            $user->licence = $path;
        }

        if ($request->hasFile('certificate')) {
            $this->validate($request, [
                'certificate' => 'max:10000|mimes:doc,docx,pdf,jpg,jpeg,png',
            ]);

            $file2 = $request->file('certificate');
            $path2 = Storage::putFileAs(
                'public/drivers/' . $request->email,
                $file2,
                'certificate' . '-' . $request->email . '-' . time() . '.' . $file2->getClientOriginalExtension(),
            );

            $user->birth_certifacate = $path2;
        }


        $user->name = $request->name;
        $user->fname = $request->first_name;
        $user->lname = $request->last_name;
        $user->phone = $request->phone_number;
        $user->verified = $request->verified  == 'yes' ? true : false;
        $user->save();

        if ($user) {
            Activity::create([
                'action' => 'ADD DRIVER',
                'description' => 'Driver ' . $user->name . ' with email ' . $user->email . ' was updated successful',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Driver successful updated');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'ADD DRIVER',
                'description' => 'Driver ' . $user->name . ' with email ' . $user->email . ' failed to updated',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Driver unsuccessful updated');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'driver_id' => 'required|numeric',
        ]);

        $driver = User::where('id', $request->driver_id)->first();

        if (!is_null($driver)) {
            $temp = $driver;

            $driver->delete();

            Activity::create([
                'action' => 'DELETE DRIVER',
                'description' => 'Driver ' . $temp->name . ' with email ' . $temp->email . ' was deleted successful',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Driver deleted successful');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'DELETE DRIVER',
                'description' => 'Driver ' . $request->driver_id . '  failed to deleted',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Driver  unsuccessful deleted');
            return redirect()->back();
        }
    }


    public function expense(Request $request)
    {
        $expenses = Expense::orderBy('updated_at', 'desc')->paginate(20);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $expenses = Expense::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('platenumber', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('condition', $search)
                        ->paginate(15);
                } else {
                    $expenses = Expense::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $expenses = Expense::orderBy('updated_at', 'desc')
                        ->whereDate('updated_at', $request->date)
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('platenumber', 'LIKE', '%' . $search . '%')
                        ->orWhere('reg_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('condition', $search)
                        ->paginate(15);
                } else {
                    $expenses = Expense::orderBy('updated_at', 'desc')
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

                $expenses = Expense::orderBy('updated_at', 'desc')
                    ->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('platenumber', 'LIKE', '%' . $search . '%')
                    ->orWhere('reg_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('condition', $search)
                    ->paginate(15);
            }
        }

        return view('mechanics.expense')->with('expenses', $expenses);
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
                    $drivers = User::orderBy('updated_at', 'desc')
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


        return view('services.driver')->with('drivers', $drivers);
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

    public function delivered(Request $request, $id)
    {
        $this->validate($request, [
            'confirm_delivered' => 'required|string|in:yes,no',
        ]);

        $route = Route::find($id);
        if (!is_null($route) && $request->confirm_delivered == 'yes') {
            $route->status = 'delivered';
            $route->save();

            if ($route) {
                Activity::create([
                    'action' => 'UPDATE ROUTE STATUS',
                    'description' => 'Route status for route ' . $route->route . ' was updated successful',
                    'user_id' => auth()->user()->id,
                ]);

                Session::flash('message', 'Route successful confirmed');
                return redirect()->back();
            } else {
                Activity::create([
                    'action' => 'UPDATE ROUTE STATUS',
                    'description' => 'Route status for route ' . $id . ' failed to delete',
                    'user_id' => auth()->user()->id,
                ]);

                Session::flash('message', 'Route unsuccessful confirmed');
                return redirect()->back();
            }
        } else {
            Activity::create([
                'action' => 'UPDATE ROUTE STATUS',
                'description' => 'Route status for route ' . $id . ' failed to delete',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Please check the route name again!');
            return redirect()->back();
        }
    }
}
