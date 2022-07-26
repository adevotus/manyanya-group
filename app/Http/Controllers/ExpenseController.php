<?php

namespace App\Http\Controllers;

use App\Exports\ExpenseExport;
use App\Models\Activity;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Excel;

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
        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('manager') || auth()->user()->hasRole('muhasibu')) {

            if (!is_null($request->date)) {

                if (strlen($request->date) > 16) {
                    $fromdate = substr($request->date, 0, -14);
                    $toDate =  substr($request->date, -10);

                    if (!is_null($request->search)) {
                        $this->validate($request, [
                            'search' => 'string',
                        ]);

                        $search = $request->search;


                        $expenses = Expense::orderBy('created_at', 'desc')
                            ->where('description', 'LIKE', '%' . $search . '%')
                            ->orWhere(function ($query) use ($search) {
                                return $query->whereHas('user', function ($querys) use ($search) {
                                    return $querys->where('name', 'LIKE', '%' . $search . '%');
                                });
                            })
                            ->whereBetween('created_at',  array($fromdate, $toDate))
                            ->paginate(15);
                    } else {
                        $expenses = Expense::orderBy('created_at', 'desc')
                            ->whereBetween('created_at',  array($fromdate, $toDate))
                            ->paginate(15);
                    }
                } else {
                    if (!is_null($request->search)) {
                        $this->validate($request, [
                            'search' => 'string',
                        ]);

                        $search = $request->search;

                        $expenses = Expense::orderBy('created_at', 'desc')
                            ->where('description', 'LIKE', '%' . $search . '%')
                            ->orWhere(function ($query) use ($search) {
                                return $query->whereHas('user', function ($querys) use ($search) {
                                    return $querys->where('name', 'LIKE', '%' . $search . '%');
                                });
                            })
                            ->whereDate('created_at', $request->date)
                            ->paginate(15);
                    } else {
                        $expenses = Expense::orderBy('created_at', 'desc')
                            ->whereDate('created_at', $request->date)
                            ->paginate(15);
                    }
                }
            } else if (!is_null($request->search)) {
                $this->validate($request, [
                    'search' => 'string',
                ]);

                $search = $request->search;

                $expenses = Expense::orderBy('created_at', 'desc')
                    ->where('description', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('user', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->paginate(15);
            } else {
                $expenses = Expense::orderBy('created_at', 'desc')->paginate(20);
            }
        } else {
            $expenses = Expense::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(20);

            if (!is_null($request->date)) {
                if (strlen($request->date) > 16) {
                    $fromdate = substr($request->date, 0, -14);
                    $toDate =  substr($request->date, -10);

                    if (!is_null($request->search)) {
                        $this->validate($request, [
                            'search' => 'string',
                        ]);

                        $search = $request->search;

                        $expenses = Expense::orderBy('created_at', 'desc')
                            ->where('user_id', auth()->user()->id)
                            ->where('description', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('user', function ($query) use ($search) {
                                return $query->where('name', 'LIKE', '%' . $search . '%');
                            })
                            ->whereBetween('created_at', [$fromdate, $toDate])
                            ->paginate(15);
                    } else {
                        $expenses = Expense::orderBy('created_at', 'desc')
                            ->where('user_id', auth()->user()->id)
                            ->whereBetween('created_at', [$fromdate, $toDate])
                            ->paginate(15);
                    }
                } else {

                    if (!is_null($request->search)) {
                        $this->validate($request, [
                            'search' => 'string',
                        ]);

                        $search = $request->search;

                        $expenses = Expense::orderBy('created_at', 'desc')
                            ->where('user_id', auth()->user()->id)
                            ->where('description', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('user', function ($query) use ($search) {
                                return $query->where('name', 'LIKE', '%' . $search . '%');
                            })
                            ->whereDate('created_at', $request->date)
                            ->paginate(15);
                    } else {
                        $expenses = Expense::orderBy('created_at', 'desc')
                            ->whereDate('created_at', $request->date)
                            ->paginate(15);
                    }
                }
            } else if (!is_null($request->search)) {
                $this->validate($request, [
                    'search' => 'string',
                ]);

                $search = $request->search;

                $expenses = Expense::orderBy('created_at', 'desc')
                    ->where('user_id', auth()->user()->id)
                    ->where('description', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('user', function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->paginate(15);
            }
        }

        $total = 0;
        foreach ($expenses as $exp) {
            $total += $exp->amount;
        }

        return view('services.expense')->with('expenses', $expenses)->with('total', $total);
    }

    public function downloadCSV(Request $request)
    {
        return Excel::download(new ExpenseExport($request->search, $request->date), 'Expenses-' . Carbon::now()->format('Y-m-d') . '.csv');
    }

    public function downloadExcel(Request $request)
    {
        return Excel::download(new ExpenseExport($request->search, $request->date), 'Expenses-' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }

    public function downloadPDF(Request $request)
    {
        return Excel::download(new ExpenseExport($request->search, $request->date), 'Expenses-' . Carbon::now()->format('Y-m-d') . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
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
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $expense = Expense::create([
                'description' => $request->description,
                'amount' => $request->amount,
                'user_id' => auth()->user()->id,
            ]);
        }

        if ($expense) {
            Activity::create([
                'action' => 'ADD EXPENSE SPENT',
                'description' => 'Expense with amount ' . $expense->amount . ' was added',
                'user_id' =>  auth()->user()->id,
            ]);

            Session::flash('message', 'Expenses successful created');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'ADD EXPENSE SPENT',
                'description' => 'Failed to add expense',
                'user_id' =>  rand(1, 50),
            ]);

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

            Activity::create([
                'action' => 'UPDATE EXPENSE SPENT',
                'description' => 'Expense with amount ' . $expense->amount . ' was updated',
                'user_id' =>  auth()->user()->id,
            ]);

            Session::flash('message', 'Expense spent successful updated');
            return redirect()->back();
        } else {
            Activity::create([
                'action' => 'UPDATE EXPENSE SPENT',
                'description' => 'Expense with amount ' . $expense->amount . ' failed to update',
                'user_id' =>  auth()->user()->id,
            ]);

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

        if (is_null($expense)) {
            Activity::create([
                'action' => 'DELETE EXPENSE SPENT',
                'description' => 'Failed to delete expense ' . $request->expense_id,
                'user_id' =>  auth()->user()->id,
            ]);

            Session::flash('message', 'Failed to deleted expense');
            return redirect()->back();
        } else {
            $temp = $expense;

            $expense->delete();

            Activity::create([
                'action' => 'ADD EXPENSE SPENT',
                'description' => 'Expense with amount ' . $temp->amount . ' was deleted',
                'user_id' =>  auth()->user()->id,
            ]);

            Session::flash('message', 'Expense spent successful deleted');
            return redirect()->back();
        }
    }
}
