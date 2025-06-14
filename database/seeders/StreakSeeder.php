<?php

namespace Database\Seeders;

use App\Models\Streak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StreakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Streak::factory()->count(20)->create();
    }
}
