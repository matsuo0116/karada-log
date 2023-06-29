<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Log;
use App\Models\Type;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogTypes>
 */
class LogTypesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),  
            'log_id' => Log::factory(),  
            'weight' => fake()->numerify('##'),
            'count' => fake()->numerify('##'),
            'sets' => fake()->numerify('##'),
            'type_id' => Type::factory(),
        ];
    }
}
