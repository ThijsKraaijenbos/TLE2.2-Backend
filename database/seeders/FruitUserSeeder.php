<?php

namespace Database\Seeders;

use App\Models\Fruit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FruitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // Retrieve all info of the models (Fruit and User)

    public function run(): void
    {
        if (User::count() === 0) {
            User::factory()->count(1)->create();
        }
        if (Fruit::count() === 0) {
            Fruit::factory()->count(1)->create();
        }


        $users = User::all();

        foreach ($users as $user) {
            // In this case scenario we want to add to the random fruit ID's and get a random model
            $randomChosenFruits = Fruit::query()->inRandomOrder()->first('id');
            //attach() will always add a new record to the pivot table,
            // whereas syncWithoutDetaching() will only add a new record if one does not exist.
            $user->fruits()->attach($randomChosenFruits, [
                'has_eaten_before' => fake()->boolean(),
                'like' => fake()->boolean(),
            ]);

        }
    }
}
