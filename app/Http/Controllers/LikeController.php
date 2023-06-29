<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Log;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function add(Request $request, $id) {
        $user = $request->user();
        $log = Log::find($id);

        $my_like = Like::where('user_id', $user->id)->where('log_id', $log->id)->exists();

        if($my_like){
            Like::where('user_id', $user->id)->where('log_id', $log->id)->delete();
        } else {
            $like = new Like();
            $like->log_id = $log->id;
            $like->user_id = $user->id;
            $like->save();
        }
        return redirect()->back();
    }
}
