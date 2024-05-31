<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'       => fake()->company(),
            'code'        => rand(1000, 9999),
            'description' => fake()->paragraph(),
            'amount'      => fake()->numberBetween(100, 10000),
            'category_id' => Category::factory(),
        ];
    }
}
