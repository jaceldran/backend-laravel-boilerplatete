<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FakeSaleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date' => fake()->dateTimeBetween('-6 months'),
            'customer' => fake()->company(),
            'product' => fake()->numerify('product-#'),
            'category' => fake()->numerify('category-#'),
            'amount' => fake()->numberBetween(1000, 100000000)
        ];
    }
}
