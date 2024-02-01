<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FakeSaleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date' => fake()->dateTimeBetween('-6 months'),
            'customer' => fake()->company(),
            'product' => fake()->numerify('product-#'),
            'category' => fake()->numerify('category-#'),
            'amount' => fake()->numberBetween(100, 100000)
        ];
    }
}
