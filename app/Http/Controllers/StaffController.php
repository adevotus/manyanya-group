<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:superadmin|manager');
    }

    // Staff Members
    public function staff(Request $request)
    {
        $staffs = User::whereRoleIs(['superadmin', 'manager', 'muhasibu', 'mechanics', 'storekeeper'])->orderBy('updated_at', 'desc')->paginate(20);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $staffs = User::orderBy('updated_at', 'desc')->whereRoleIs(['superadmin', 'manager', 'mechanics', 'muhasibu', 'storekeeper'])
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('fname', 'LIKE', '%' . $search . '%')
                        ->orWhere('lname', 'LIKE', '%' . $search . '%')
                        // ->orWhere('status', $search)
                        ->paginate(15);
                } else {
                    $staffs = User::orderBy('updated_at', 'desc')
                        ->whereRoleIs(['superadmin', 'manager', 'mechanics', 'muhasibu', 'storekeeper'])
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $staffs = User::orderBy('updated_at', 'desc')->whereRoleIs(['superadmin', 'manager', 'mechanics', 'muhasibu', 'storekeeper'])
                        ->whereDate('updated_at', $request->date)
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('fname', 'LIKE', '%' . $search . '%')
                        ->orWhere('lname', 'LIKE', '%' . $search . '%')
                        ->paginate(15);
                } else {
                    $staffs = User::orderBy('updated_at', 'desc')->whereRoleIs(['superadmin', 'manager', 'mechanics', 'muhasibu', 'storekeeper'])
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

                $staffs = User::orderBy('updated_at', 'desc')->whereRoleIs(['superadmin', 'manager', 'mechanics', 'muhasibu', 'storekeeper'])
                    ->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('fname', 'LIKE', '%' . $search . '%')
                    ->orWhere('lname', 'LIKE', '%' . $search . '%')
                    ->paginate(15);
            }
        }


        return view('admin.staff')->with('staffs', $staffs);
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:255', 'in:superadmin,manager,mechanics,storekeeper,muhasibu'],
        ]);


        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'fname' => $request->first_name,
            'lname' => $request->last_name,
            'password' => bcrypt($request->password),
        ]);

        if ($request->role == 'superadmin') {
            if (auth()->user()->hasRole('superadmin')) {
                $user->attachRole($request->role);
            } else {
                abort(403);
            }
        } else {
            $user->attachRole($request->role);
        }



        if (!is_null($user)) {
            Activity::create([
                'action' => 'ADD STAFF USER',
                'description' => 'User ' . $user->name . ' with email ' . $user->email . ' was added successful',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Staff member successful created');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'ADD USER',
                'description' => 'User ' . $request->name . ' with email ' . $request->email . ' failed to be added',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Staff member unsuccessful created');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'staff_id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255', 'in:superadmin,manager,mechanics,storekeeper,muhasibu'],
        ]);

        $user = User::find($request->staff_id);

        if ($user->email != $request->email) {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);

            $user->email = $request->email;
        }

        $user->name = $request->name;
        $user->fname = $request->first_name;
        $user->lname = $request->last_name;
        $user->save();

        foreach ($user->roles as $role) {
            if ($role->name != $request->role) {
                if ($request->role == 'superadmin' || $role->name == 'superadmin') {
                    if (auth()->user()->hasRole('superadmin')) {
                        $user->detachRole($role);
                        $user->attachRole($request->role);
                    } else {
                        abort(403);
                    }
                } else {
                    $user->detachRole($role);
                    $user->attachRole($request->role);
                }
            }
        }

        if (!is_null($user)) {
            Activity::create([
                'action' => 'UPDATE STAFF USER',
                'description' => 'User ' . $user->name . ' with email ' . $user->email . ' was updated successful',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Staff member successful updated');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'UPDATE STAFF USER',
                'description' => 'User ' . $request->name . ' with email ' . $request->email . ' failed to update',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Staff member unsuccessful updated');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'staff_id' => 'required|numeric',
        ]);

        $staff = User::where('id', $request->staff_id)->first();

        if (!is_null($staff)) {
            $temp = $staff;

            $staff->delete();

            Activity::create([
                'action' => 'DELETE STAFF USER',
                'description' => 'User ' . $temp->name . ' with email ' . $temp->email . ' was deleted successful',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Staff member deleted successful ');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'DELETE STAFF USER',
                'description' => 'User with id ' . $request->staff_id . ' failed to delete',
                'user_id' => auth()->user()->id,
            ]);

            Session::flash('message', 'Staff member  unsuccessful deleted');
            return redirect()->back();
        }
    }
}
