<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OpportunityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'  => fake()->sentence(),
            'status' => fake()->randomElement(['open', 'won', 'lost']),
            'amount' => fake()->numberBetween(100, 10000),
        ];
    }

    public function deleted(): Factory
    {
        return $this->state(fn (array $attributes) => ['deleted_at' => now()]);
    }
}
