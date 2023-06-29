<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Log;
use App\Models\Notification;

class HomeTest extends TestCase
{

    //TOPページのデータ取得
    public function test_home(): void
    {
        $user = User::factory()->create();
        $my_like = 0;
        $like_counts = [
            1 => 1,
            2 => 2
        ];

        $notification = 1;
        $logs = Log::factory()->create();

        $touya = User::factory()->create(['name' => 'touya']);
        $my_logs = Log::factory(4)->for($touya)->create();
        $response = $this->actingAs($touya)
                         ->get('/',  ['my_logs' => $my_logs, 'logs' => $logs, 'user' => $user, 'like_counts' => $like_counts, 'my_like' => $my_like, 'notification' => $notification ]);
        $response->assertStatus(200)
        ->assertSee('ようこそ、touyaさん');
    }

    //個別のログページの表示
    public function test_log_detail(): void
    {
        $log = Log::factory()->create();

        $response = $this->actingAs($log->user)->get('/log/'.$log->id);
        
        $response->assertStatus(200)->assertSee($log->comment);
    }

    //コメント投稿機能のテスト
    public function test_log_comment(): void
    {
        $log = Log::factory()->create();

        $comment = [
            'comment' => 'コメント本文',
            'log_id' => $log->id,
            'user_id' => $log->user->id,
        ];
        
        $response = $this->actingAs($log->user)->post('log/comment/'.$log->id, $comment);
        // $this->dumpdb();
        $response->assertRedirect('/log/' . $log->id);
    }

    //いいねボタン機能のテスト
    public function test_like_button(): void
    {
        $log = Log::factory()->create();

        $like = [
            'user_id' => $log->user->id,
            'log_id' => $log->id,
        ];
        $response = $this->actingAs($log->user)->post('/like/'.$log->id, $like);
        
        $response->assertRedirect('/');
    }

    public function test_show_notifications(): void
    {
        $user = User::factory()->create();

        // false 未読通知
        $notification1 = Notification::factory()->create([
            'user_id' => $user->id,
            'read' => false,
        ]);

        // true 既読通知
        $notification2 = Notification::factory()->create([
            'user_id' => $user->id,
            'read' => true,
        ]);

        $response = $this->actingAs($user)->get('/notification');
        $response->assertStatus(200);

        $response->assertSee($notification1->comment->text);
        $response->assertDontSee($notification2->comment->text);
    }

    public function test_notifications_read(): void
    {
        $user = User::factory()->create();

        // ２件ともfalse:未読の通知
        $notification1 = Notification::factory()->create([
            'user_id' => $user->id,
            'read' => false,
        ]);

        $notification2 = Notification::factory()->create([
            'user_id' => $user->id,
            'read' => false,
        ]);

        //postでアクセスするとreadがtrueになる
        $response = $this->actingAs($user)->get('/notification/'.$notification1->id);
        $response->assertRedirect('/log/'.$notification1->comment->log->id);

        // 通知1のみ既読となり、お知らせ画面に表示されない
        $this->get('/notification')->assertDontSee($notification1->comment->text)->assertSee($notification2->comment->text);

    }
}
