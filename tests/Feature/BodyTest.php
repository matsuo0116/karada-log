<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Log;

class BodyTest extends TestCase
{
  

    //カラダログ記録ページの表示
    public function test_body(): void
    {
        $user = User::factory()->make(['name' => 'touya']);
        
        $response = $this->actingAs($user)
                         ->get('/body');
        $response->assertStatus(200);
        // $this->dumpdb();
    }
    
    //カラダログ記録ページのフォーム送信後の動作
    public function test_body_form(): void
    {
        $user = User::factory()->create();

        $data = [
            'weight' => '50',
            'fat_per' => '20',
            'user_id' => $user->id,
        ];

        $response = $this->actingAs($user)->withSession(['key' => 'value'])->post('/body',$data);

        // $this->assertAuthenticated();
        $response->assertRedirect(route('body'));

        $this->get('/body')->assertOk()
        ->assertSee('入力が完了しました！');
        $this->dumpdb();
        $this->assertDatabaseHas('logs',$data );
    }

}
