<?php

namespace Database\Factories;

use App\Models\Fruit;
use App\Models\FunFact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FunFact>
 */
class FunFactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'fruit_id' => Fruit::query()->inRandomOrder()->value('id') ?? Fruit::factory(),
            'fruit_fact' => fake()->realTextBetween(50,200),
        ];
    }
}
