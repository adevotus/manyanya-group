<?php

namespace App\Http\Controllers\Home;
use App\Models\CustomerRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function contact(){
        return view ('sections.contact');
    }

    public function CustomerRequest(){
        $this->validate($request,[
            'name' => 'required|string|max:20',
            'email' => 'required|string|max:30',
            'phonenumber' => 'required|numeric',
            'notices' =>'required|string|numeric:200',
             'vehicle_id' => 'required|'
        
        ]);
       dd(all);

       $customerrequrest = CustomerRequest::create([
        'name' => $request->customername,
        'phonenumber' => $request->phone,
        'email' => $request->email,
        'notices' => $request->notices,
        'vehicle_id' => $request->vehivle_id,
  
    ]);

      return redirect()->back()->withErrors($validator)->withInput();('/');
    }
}
