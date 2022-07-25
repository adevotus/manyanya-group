<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:superadmin|manager');
    }

    public function index(Request $request)
    {
        $activities = Activity::orderBy('updated_at', 'desc')->paginate(15);

        if (!is_null($request->date)) {
            if (strlen($request->date) > 16) {
                $fromdate = substr($request->date, 0, -14);
                $toDate =  substr($request->date, -10);

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $activities = Activity::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->where('action', 'LIKE', '%' . $search . '%')
                        ->orWhere(function ($querys) use ($search) {
                            return  $querys->whereHas('user', function ($query) use ($search) {
                                return $query->where('name', 'LIKE', '%' . $search . '%');
                            });
                        })
                        ->paginate(15);
                } else {
                    $activities = Activity::orderBy('updated_at', 'desc')
                        ->whereBetween('updated_at', [$fromdate, $toDate])
                        ->paginate(15);
                }
            } else {

                if (!is_null($request->search)) {
                    $this->validate($request, [
                        'search' => 'string',
                    ]);

                    $search = $request->search;

                    $activities = Activity::orderBy('updated_at', 'desc')
                        ->whereDate('updated_at', $request->date)
                        ->where('action', 'LIKE', '%' . $search . '%')
                        ->orWhere(function ($querys) use ($search) {
                            return  $querys->whereHas('user', function ($query) use ($search) {
                                return $query->where('name', 'LIKE', '%' . $search . '%');
                            });
                        })
                        ->paginate(15);
                } else {
                    $activities = Activity::orderBy('updated_at', 'desc')
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

                $activities = Activity::orderBy('updated_at', 'desc')
                    ->where('action', 'LIKE', '%' . $search . '%')
                    ->orWhere(function ($querys) use ($search) {
                        return  $querys->whereHas('user', function ($query) use ($search) {
                            return $query->where('name', 'LIKE', '%' . $search . '%');
                        });
                    })
                    ->paginate(15);
            }
        }

        return view('services.activity', compact('activities'));
    }

    public function destroy($id)
    {
        $activity = Activity::where('id', $id)->first();
        if (!is_null($activity)) {
            $desc = $activity->description;
            if ($activity->delete()) {
                Activity::create([
                    'action' => "DELETE ACTIVITY",
                    'description' => 'Activity ' . $desc . ' is deleted',
                    'user_id' => auth()->user()->id,
                ]);

                Session::flash('message', 'Activity successful deleted');
                return redirect()->back();
            } else {
                Activity::create([
                    'action' => "DELETE ACTIVITY",
                    'description' => 'Activity ' . $desc . ' is unsuccessful deleted',
                    'user_id' => auth()->user()->id,
                ]);

                Session::flash('message', 'Activity unsuccessful deleted');
                return redirect()->back();
            }
        } else {
            Session::flash('message', 'Activity unsuccessful deleted');

            Activity::create([
                'action' => "DELETE ACTIVITY",
                'description' => 'Activity to deleted was not found',
                'user_id' => auth()->user()->id,
            ]);
            return redirect()->back();
        }
    }
}
