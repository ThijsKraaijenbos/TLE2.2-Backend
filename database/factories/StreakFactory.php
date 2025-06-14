<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Streak>
 */
class StreakFactory extends Factory
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
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'start_date' => fake()->date('Y-m-d'),
            'last_completed_date' => fake()->date('Y-m-d'),
            'current_streak' => fake()->numberBetween(1, 30),
            'longest_streak' => fake()->numberBetween(20, 30),
        ];
    }
}
