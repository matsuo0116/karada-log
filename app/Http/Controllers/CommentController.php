<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Notification;

class CommentController extends Controller
{
    public function comment(Request $request, $id) {
        //コメント投稿内容をテーブルに保存
        $comment = new Comment();
        $user = $request->user();
        $comment->user_id = $user->id;
        $comment->text = $request->input('comment');
        $comment->log_id = $id;
        $comment->save();

        //通知をテーブルに保存
        if($user->id !== $comment->log->user_id) {
            Notification::create([
                'comment_id' => $comment->id,
                'user_id' => $comment->log->user_id,
                'read' => false,
            ]);
        }

        return redirect('/log/'.$id);
    }
}
