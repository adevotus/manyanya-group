<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:superadmin|driver|storekeeper|mechanics|muhasibu|manager');
    }

    // Expenses
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

        return view('services.expense')->with('expenses', $expenses);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|gte:1',
        ]);

        if ($request->hasFile('payment_slip')) {
            $this->validate($request, [
                'payment_slip' => 'required|mimes:png,jpeg,jpg,docx,pdf,docs|max:1000',
            ]);

            $file = $request->file('payment_slip');

            $path = Storage::putFileAs(
                'public/expenses/' . $request->email,
                $file,
                'tools' . '-' . $request->tool_name . '-' . time() . '.' . $file->getClientOriginalExtension(),
            );

            $expense = Expense::create([
                'description' => $request->description,
                'amount' => $request->amount,
                'slip' => $path,
            ]);
        } else {
            $expense = Expense::create([
                'description' => $request->description,
                'amount' => $request->amount,
            ]);
        }

        if ($expense) {
            Session::flash('message', 'Expenses successful created');
            return redirect()->back();
        } else {
            Session::flash('message', 'Expenses unsuccessful created');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|gte:1',
        ]);

        $expense = Expense::find($request->expense_id);

        if ($expense) {
            $expense->description = $request->description;
            $expense->amount = $request->amount;

            if ($request->hasFile('payment_slip')) {
                $this->validate($request, [
                    'payment_slip' => 'required|mimes:png,jpeg,jpg,docx,pdf,docs|max:1000',
                ]);

                $file = $request->file('payment_slip');

                $path = Storage::putFileAs(
                    'public/expenses/' . $request->email,
                    $file,
                    'tools' . '-' . $request->description . '-' . time() . '.' . $file->getClientOriginalExtension(),
                );

                $expense->slip = $path;
            }

            $expense->save();

            Session::flash('message', 'Expense spent successful updated');
            return redirect()->back();
        } else {
            Session::flash('message', 'Expense spent unsuccessful updated');
            return redirect()->back();
        }
    }


    public function destroy(Request $request)
    {
        $this->validate($request, [
            'expense_id' => 'required|numeric',
        ]);

        $expense = Expense::where('id', $request->expense_id)->first();

        if (!is_null($expense)) {
            $expense->delete();

            Session::flash('message', 'Expense spent deleted successful');
            return redirect()->back();
        } else {
            Session::flash('message', 'Expense spent  unsuccessful deleted');
            return redirect()->back();
        }
    }
}
