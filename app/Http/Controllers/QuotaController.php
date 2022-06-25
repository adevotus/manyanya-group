<?php

namespace App\Http\Controllers;

use App\Mail\QuoteMail;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class QuotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:superadmin|manager|muhasibu');
    }

    public function index(Request $request)
    {
        $quotas = Quote::orderBy('updated_at', 'desc')->paginate(20);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $quotas = Quote::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->orWhere('message', $search)
                        ->paginate(15);
                } else {
                    $quotas = Quote::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $quotas = Quote::orderBy('updated_at', 'desc')
                        ->whereDate('updated_at', $request->date)
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->orWhere('message', $search)
                        ->paginate(15);
                } else {
                    $quotas = Quote::orderBy('updated_at', 'desc')
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

                $quotas = Quote::orderBy('updated_at', 'desc')
                    ->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('message', $search)
                    ->paginate(15);
            }
        }

        return view('services.quote')->with('quotas', $quotas);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'reply' => 'required|string',
        ]);

        try {
            Mail::to($request->email)->send(new QuoteMail($request->name, $request->phone_number, $request->email, $request->reply));

            Session::flash('message', 'Reply was successful sent');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('message', 'Reply was unsuccessful sent');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $quote = Quote::where('id', $id)->first();

        if (!is_null($quote)) {
            $quote->delete();

            Session::flash('message', 'Message deleted successful');
            return redirect()->back();
        } else {
            Session::flash('message', 'Message  unsuccessful deleted');
            return redirect()->back();
        }
    }
}
