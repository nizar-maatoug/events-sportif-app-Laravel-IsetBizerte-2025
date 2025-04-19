<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventSportif>
 */
class EventSportifFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name=fake()->unique()->name(),
            'slug'=> Str::slug($name),
            'sport' => fake()->randomElement(['TaeKwondo', 'Judo', 'Karate', 'Boxe', 'KungFu', 'Aikido']),
            'description' => fake()->sentence(6),
            'location' => fake()->city(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'status' => fake()->randomElement(['open', 'closed', 'cancelled']),
        ];
    }
}
