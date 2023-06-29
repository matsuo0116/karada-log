<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Type::create([
        //     'name' => 'ラットプルダウン',
        //     'part_id' => '2',
        //     'category_id' => '3'
        // ]);
        Type::create([
            'name' => 'ショルダープレス',
            'part_id' => '3',
            'category_id' => '3'
        ]);
        Type::create([
            'name' => 'スクワット',
            'part_id' => '4',
            'category_id' => '3'
        ]);
        Type::create([
            'name' => 'アブドミナル',
            'part_id' => '5',
            'category_id' => '3'
        ]);
        Type::create([
            'name' => 'ダンベルカール',
            'part_id' => '6',
            'category_id' => '3'
        ]);
    }
}
