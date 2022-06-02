<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => Product::TYPES[rand(0, 2)],
            'name' => Str::random(rand(6, 10)),
            'price' => rand(10, 100)
        ];
    }
}
