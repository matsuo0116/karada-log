<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Log;
use App\Models\LogTypes;
use App\Models\Part;
use App\Models\Type;

class TrainingTest extends TestCase
{
    //トレーニング記録ページの表示
    public function test_training_get(): void
    {
        $user = User::factory()->make(['name' => 'touya']);
        
        $response = $this->actingAs($user)
                         ->get('/training');
        $response->assertStatus(200);
    }

    public function test_training_form(): void
    {

        $training = LogTypes::factory()->create();
        
        $data = [
            'log' => [
                $training->type->id => [
                    'user_id' => $training->user->id,
                    'log_id' => $training->log->id,
                    'weight' => $training->weight,
                    'count' => $training->count,
                    'sets' => $training->sets,
                ],
            ],
        ];
        $this->dumpdb();
        $response = $this->actingAs($training->user)->post(route('training.create'), $data);
        $response->assertRedirect(route('index'));
        
        $this->assertDatabaseHas('log_types',$data['log'][$training->type->id] );
    }

}
