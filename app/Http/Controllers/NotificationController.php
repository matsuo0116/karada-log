<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function show(Request $request) {
        $user = $request->user();
        $notifications = Notification::where('user_id',$user->id)->where('read',false)->get();
        return view('notification', [ 'notifications' => $notifications]);
    }

    public function read(Request $request, $id){
        $notification = Notification::findOrFail($id);

        $notification->read = true;
        $notification->save();

        return redirect()->route('log.show', ['id' => $notification->comment->log->id ]);
    }
}
