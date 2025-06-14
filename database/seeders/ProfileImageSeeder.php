<?php

namespace Database\Seeders;

use App\Models\ProfileImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This
        ProfileImage::factory()->count(10)->create();
    }
}
