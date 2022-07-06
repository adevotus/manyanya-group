<?php

namespace App\Http\Controllers\Home;

use App\Models\CustomerRequest;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $post = Post::orderBy('updated_at', 'desc')->take(3)->get();

        return view('home')->with('posts', $post);
    }

    public function contact()
    {
        return view('sections.contact');
    }

    public function qoute(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:30',
            'phone_number' => 'required|string|max:20',
            'message' => 'required|string|max:255',
        ]);

        $quote = Quote::create([
            'name' => $request->name,
            'phone' => $request->phone_number,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        if ($quote) {
            Session::flash('message', 'Quote was successful sent');
            return redirect()->back();
        } else {
            Session::flash('message', 'Quote was unsuccessful sent');
            return redirect()->back();
        }
    }
}
