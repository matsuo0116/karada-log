<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Like;

class ShowController extends Controller
{
    public function show(Request $request,$id) {
        $user = $request->user();
        $log = Log::find($id);

        if($log) {
            $my_like[$log->id] = $user ? Like::where('user_id', $user->id)->where('log_id', $log->id)->exists() : false ;
            $like_counts = $log->likes()->count(); 

            return view('show', [ 'log' => $log, 'like_counts' => $like_counts, 'my_like' => $my_like ]);
        } else {
            return redirect()->route('index');
        }
        
    }
}
