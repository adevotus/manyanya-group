<?php

namespace App\Http\Controllers\Storekeeper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PathrouterController extends Controller
{
        public function pathroute()

    {
        return view('stockkeeper.pages.Pathroute');

        // if(Auth::check()){
        //     return view('dashboard');
        // }
  
        // return redirect("/")->withSuccess('You are not allowed to access');
    }

    public function storedrivers(){
        return view('stockkeeper.pages.sto-drivers');
    }
}
