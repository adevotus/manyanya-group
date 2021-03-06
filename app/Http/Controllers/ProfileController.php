<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:mechanics|manager|driver|muhasibu|superadmin|storekeeper');
    }

    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        if ($user) {

            if ($request->hasFile('profile_picture')) {
                $this->validate($request, [
                    'profile_picture' => 'required|image|max:4096|mimes:jpg,jpeg,png',
                ]);

                $file = $request->file('profile_picture');

                $path = Storage::putFileAs(
                    'public/profile/' . Str::slug(auth()->user()->name),
                    $file,
                    time() . '.' . $file->getClientOriginalExtension(),
                );

                $user->profile = $path;
            }

            if ($request->email != auth()->user()->email) {
                $this->validate($request, [
                    'email' => 'required|email|unique:users|max:255',
                ]);

                $user->email = $request->email;
            }

            $user->fname = $request->first_name;
            $user->lname = $request->last_name;
            $user->name = $request->name;

            $user->save();

            Session::flash('message', 'User successful updated');
        } else {
            Session::flash('message', 'User unsuccessful updated');
        }
        return redirect()->back();
    }

    public function password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'min:8', 'string', 'confirmed'],
        ]);

        $user = User::find(auth()->user()->id)->update(['password' => bcrypt($request->password)]);

        if ($user) {
            Session::flash('password', 'Password successful updated');
            Session::flash('message', 'Password successful updated');
        } else {
            Session::flash('password', 'Password unsuccessful updated');
            Session::flash('message', 'Password unsuccessful updated');
        }

        return redirect()->back();
    }
}
