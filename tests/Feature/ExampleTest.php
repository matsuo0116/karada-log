<?php

namespace Tests\Feature;

use App\Models\Log;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */

    // public function test_the_application_returns_a_successful_response(): void
    // {
    //     $sayuri = User::factory()->create(['name' => 'sayuri']);
    //     $log = Log::factory(4)->for($sayuri)->create();

    //     $this->dumpdb();
    // }

    // public function test_login_screen_can_be_rendered(): void
    // {
    //     $response = $this->get('/login');

    //     $response->assertStatus(200);
    // }

    // public function test_非ログイン時は、ログイン画面に飛ばされる()
    // {
    //     $response = $this->get('/training');

    //     // ルート名 `login` にリダイレクトされるか
    //     $response->assertRedirectToRoute('login');
    // }
    // public function test_users_can_authenticate_using_the_login_screen(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this->post('/login', [
    //         'email' => $user->email,
    //         'password' => 'password',
    //     ]);

    //     $this->assertAuthenticated();
    //     $response->assertRedirectToRoute('index');
    // }

    // public function test_ログイン時は、挨拶文が表示される()
    // {
    //     $user = User::factory()->create(['name' => 'touya']);

    //     $response = $this
    //         ->actingAs($user)
    //         ->get('/');

    //     $response
    //         ->assertOk()
    //         ->assertSee('ようこそ、touyaさん');
    // }

    public function test_welcome(){
        $response = $this->get('welcome');

        $response->assertStatus(200)->assertSee('News');
    }
}
