<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'  => fake()->name,
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber,

            'linkedin'  => 'https://linkedin.com/in/' . fake()->userName,
            'facebook'  => 'https://facebook.com/' . fake()->userName,
            'instagram' => 'https://instagram.com/' . fake()->userName,
            'twitter'   => 'https://x.com/' . fake()->userName,

            'address' => fake()->address,
            'city'    => fake()->city,
            'state'   => fake()->state,
            'zip'     => fake()->postcode,
            'country' => fake()->country,

            'age'    => fake()->numberBetween(18, 65),
            'gender' => fake()->randomElement(['male', 'female', 'other']),

            'company'  => fake()->company,
            'position' => fake()->jobTitle,
        ];
    }

    public function deleted(): Factory
    {
        return $this->state(fn (array $attributes) => ['deleted_at' => now()]);
    }
}
