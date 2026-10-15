<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tweet>
 */
class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "text" => fake()->realTextBetween(5, 160),
            "likes" => fake()->numberBetween(0, 5000),
            "created_at" => fake()->dateTimeBetween('-1 year')->format('Y-m-d H:i:s'),
            "user_id" => User::factory()
        ];
    }
}
