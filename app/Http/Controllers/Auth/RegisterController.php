<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function customRegistration(Request $request)
    {
        $credentials =   $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->attachRole('driver');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->hasRole('superadmin')) {
                return redirect()->route('admin.home');
            } else if (Auth::user()->hasRole('storekeeper')) {
                return redirect()->route('storekeeper.home');
            } else if (Auth::user()->hasRole('muhasibu')) {
                return redirect()->route('muhasibu.home');
            } else if (Auth::user()->hasRole('manager')) {
                return redirect()->route('manager.home');
            } else if (Auth::user()->hasRole('driver')) {
                return redirect()->route('driver.home');
            } else {
                abort(403);
            }
        }
    }
}
