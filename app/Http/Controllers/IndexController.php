<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\LogTypes;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\DB;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $last_week = Carbon::today()->subDay(7);
        $logs = Log::orderBy('created_at','desc')->whereDate('created_at', '>=',$last_week)->get();

        if(isset($user->id)){
            $my_logs = Log::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        } else {
            $my_logs = null;
        }

        // $my_like = Like::where('user_id', $user->id)->where('log_id', $log->id)->exists();

        $like_counts = [];
        $my_like = [];
        foreach($logs as $log) {
            $like_counts[$log->id] = $log->likes()->count();
            $my_like[$log->id] = $user ? Like::where('user_id', $user->id)->where('log_id', $log->id)->exists() : false ;
        }
        
        if($request->user()){
            $notification = Notification::where('user_id',$user->id)->where('read', false)->count();
        } else {
            $notification = null;
        }
        

        // $log_type = LogTypes::all();
        return view('index', ['my_logs' => $my_logs, 'logs' => $logs, 'user' => $user, 'like_counts' => $like_counts, 'my_like' => $my_like, 'notification' => $notification ]);
    }
}
