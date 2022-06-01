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
            'type' => Product::TYPE_A,
            'name' => 'A product',
            'price' => 100
        ];
    }
}
