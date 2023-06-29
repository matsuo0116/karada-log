<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
 
            // 'id' => 1,
            'name' => 'ベンチプレス',
            'category_id' => Category::factory(),
            'part_id' => Part::factory(),
  
        ];
    }
}
