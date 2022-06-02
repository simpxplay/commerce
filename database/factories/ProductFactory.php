<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(Product::TYPES),
            'name' => $this->faker->title,
            'price' => $this->faker->numberBetween(10,100)
        ];
    }
}
