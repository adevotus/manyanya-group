<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            $total_price += $rt->price;
        }


        return view('driver.dashboard')->with('routes', $routes)->with('price', $total_price);
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

                Session::flash('message', 'Driver details successful updated');
                return redirect()->back();
            } else {
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
            if ($route->status === 'delivered') {
                if ($request->driver_status == 'yes') {
                    $user = User::find(auth()->user()->id);
                    $user->status = true;
                    $user->save();

                    Session::flash('message', 'You have change status to available');
                } else {
                    $user = User::find(auth()->user()->id);
                    $user->status = false;
                    $user->save();

                    Session::flash('message', 'You have change status to not available');
                }
            } else {
                if ($request->cargo_delivered == 'yes') {
                    $route->update([
                        'status' => 'delivered',
                    ]);

                    if ($request->cargo_delivered == 'yes') {
                        $user = User::find(auth()->user()->id);
                        $user->status = true;
                        $user->save();

                        Session::flash('message', 'Route successful updated');
                    } else {
                        Session::flash('message', 'Route successful updated');
                    }
                } else {
                    Session::flash('message', 'Unsuccessful! Deliver the first cargo first');
                }
            }
        } else {
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
                Session::flash('message', 'Driver successful created');
                return redirect()->back();
            } else {
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
            Session::flash('message', 'Driver successful updated');
            return redirect()->back();
        } else {
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
            $driver->delete();

            Session::flash('message', 'Driver deleted successful');
            return redirect()->back();
        } else {
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
}
