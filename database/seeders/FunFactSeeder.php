<?php

namespace Database\Seeders;

use App\Models\FunFact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FunFactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        FunFact::factory()->count(20)->create();
    }
}
