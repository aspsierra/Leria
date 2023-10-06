<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 100),
            'message' => fake()->text(140),
            'n_shared' => fake()->numberBetween(1, 100),
            'n_comments' => fake()->numberBetween(1, 100),
            'n_likes' => fake()->numberBetween(1, 100),
            'date' =>fake()->date(),
            'time' =>fake()->time(),
        ];
    }
}
