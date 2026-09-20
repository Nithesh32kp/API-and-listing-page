<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pro_name' => $this->faker->words(2, true),
            'price' => $this->faker->randomFloat(2, 50, 1000),
            'pro_wt' => $this->faker->randomFloat(3, 0.1, 5),
            'size' => $this->faker->numberBetween(1, 10),
            'stock' => $this->faker->numberBetween(5, 100),
        ];
    }
}
