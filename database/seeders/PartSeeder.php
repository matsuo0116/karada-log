<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Part::create([
            'name' => '背中'
        ]);
        Part::create([
            'name' => '肩'
        ]);
        Part::create([
            'name' => '脚'
        ]);
        Part::create([
            'name' => '腹筋'
        ]);
        Part::create([
            'name' => '腕'
        ]);
    }
}
