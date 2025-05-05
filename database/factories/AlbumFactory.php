<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'artist' => fake()->name(),
            'title' => fake()->sentence(),
            'genre' => fake()->word(),
            'release_year' => fake()->year(),
            'format' => fake()->randomElement(['vinyl', 'cd', 'digital']),
            'notes' => fake()->paragraph(),
        ];
    }
}