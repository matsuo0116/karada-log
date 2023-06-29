<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use  App\Http\Requests\BodyRequest;

class BodyController extends Controller
{
    public function body(BodyRequest $request){
        $login_user = $request->user();
        $today = Carbon::today();
        $latestLog = Log::whereDate('created_at', $today)->where('user_id', $login_user->id)->latest()->first();

        if($latestLog){
            $log = $latestLog;
        } else {
            $log = new Log();
            $log->weight = null;
            $log->fat_per = null;
        }

        $today = now()->format('Y年m月d日');        

        return view('body',['log' => $log, 'today' => $today, 'login_user' => $login_user ]);
    }

    public function create(BodyRequest $request){
        $login_user = $request->user();
        $today = Carbon::today();
        $latestLog = Log::whereDate('created_at', $today)->latest()->first();

        if(!$latestLog) {
            $log = new Log();     
        } else {
            $log = $latestLog;
        }
        $log->weight = $request->input('weight');
        $log->fat_per = $request->input('fat_per');
        $log->user_id = $login_user->id;
        $log->save();

        return redirect('/body')->with('flash_message', '入力が完了しました！');
    }
}
