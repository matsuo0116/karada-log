<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SettingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //設定ページの表示
    public function test_setting(): void
    {
        $user = User::factory()->create(['name' => 'touya']);
        
        $response = $this->actingAs($user)
                         ->get('/setting');
        $response->assertStatus(200);
    }

    //設定ページのプロフィールフォーム送信後の動作
    public function test_setting_profile_form(): void
    {
        $user = User::factory()->create();

        $profile = [
            'target_weight' => $user->target_weight,
            'target_fat' => $user->target_fat_per ,
            'age' => $user->age,
            'height' => $user->height,
        ];

        $response = $this->actingAs($user)->post('/setting',$profile);

        $this->assertAuthenticated();
        $response->assertRedirect(route('setting'));

        $this->get('/setting')->assertOk();

        

        $this->assertDatabaseHas('users', [
            'target_weight' => $user->target_weight,
            'target_fat_per' => $user->target_fat_per ,
            'age' => $user->age,
            'height' => $user->height,
        ]);
        
        
        
    }

    //画像をアップロード時のテスト
    public function test_image_upload(): void
    {
        $user = User::factory()->create();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('test.jpg');
        Storage::disk('public')->putFileAs('uploads', $file, $file->getClientOriginalName());

        $response = $this->actingAs($user)->post('/setting/upload', [
            'image' => $file,
        ]);
        $this->dumpdb();
        $response->assertRedirect('/setting');

        Storage::disk('public')->assertExists('uploads/' . $file->getClientOriginalName());
    }

}
