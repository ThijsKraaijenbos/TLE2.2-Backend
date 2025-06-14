<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\ProfileImage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    // Running this will automatically create the fake data:
    // php artisan db:seed DatabaseSeeder


    public function run(): void
    {
        // Create the seeders in a chronological order
        $this->call([
            ProfileImageSeeder::class,
            UserSeeder::class,
            FruitSeeder::class,
            AssignmentSeeder::class,
            FunFactSeeder::class,
            FruitUserSeeder::class,
            StreakSeeder::class

        ]);


    }
}
