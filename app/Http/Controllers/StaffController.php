<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:superadmin');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:255', 'in:superadmin,manager,storekeeper,muhasibu'],
        ]);


        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'fname' => $request->first_name,
            'lname' => $request->last_name,
            'password' => bcrypt($request->password),
        ]);

        $user->attachRole($request->role);



        if ($user) {
            Session::flash('message', 'Staff member successful created');
            return redirect()->back();
        } else {
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
            'role' => ['required', 'string', 'max:255', 'in:superadmin,manager,storekeeper,muhasibu'],
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
                $user->detachRole($role);
                $user->attachRole($request->role);
            }
        }

        if ($user) {
            Session::flash('message', 'Staff member successful updated');
            return redirect()->back();
        } else {
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
            $staff->delete();

            Session::flash('message', 'Staff member deleted successful');
            return redirect()->back();
        } else {
            Session::flash('message', 'Staff member  unsuccessful deleted');
            return redirect()->back();
        }
    }
}
