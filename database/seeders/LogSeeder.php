<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Log;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Log::create([
            'comment' => '今日は筋肉痛がひどいので軽めに！',
            'weight' => '58.2',
            'fat_per' => '17.0',
            'user_id' => '1'
        ]);
        Log::create([
            'comment' => '今日はOFFの日です。',
            'weight' => '58.4',
            'fat_per' => '17.2',
            'user_id' => '1'
        ]);
    }
}
