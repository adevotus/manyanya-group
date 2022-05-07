<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


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


        return redirect("/login")->withSuccess('Login details are not valid');
    }
    public function signOut()
    {
        FacadesSession::flush();
        Auth::logout();

        return Redirect('/login');
    }
}
