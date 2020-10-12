<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    //  activity log

    public function activityAll(Request $request)
    {
        if (Auth::user()->role == 'super-admin') {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $activity = DB::table('activitylog')->where('activity', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->latest()->paginate($perPage);
            } else {
                $activity = DB::table('activitylog')->latest()->paginate($perPage);
            }
        } else {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $activity = DB::table('activitylog')->where('user_id', Auth::user()->id)->where('activity', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->latest()->paginate($perPage);
            } else {
                $activity = DB::table('activitylog')->where('user_id', Auth::user()->id)->latest()->paginate($perPage);
            }
        }

        return view('admin.activity.index', compact('activity'));
    }
}
