<?php

namespace Database\Factories;

use App\Models\ProfileImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProfileImage>
 */
class ProfileImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProfileImage::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'file_path' => fake()->imageUrl()
        ];
    }
}
