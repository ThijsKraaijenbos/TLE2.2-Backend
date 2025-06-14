<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fruit>
 */
class FruitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Create fake data for the database start with the
            // column_name => fake() -> datatype
            // 'price'=>fake()->numberBetween(1,number_format(20,2,'.')),
            'name'=>fake()->name(),
            'description'=>fake()->realText(100),
            'price'=>fake()->numberBetween(1,20),
            'big_img_file_path'=>fake()->imageUrl(),
            'small_img_file_path'=>fake()->imageUrl(),
            'weight'=>fake()->biasedNumberBetween(0,2000),
            'serving_size'=>fake()->numberBetween(1,20),
        ];
    }
}
