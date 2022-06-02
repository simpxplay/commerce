<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VoucherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => Str::random(8),
            'type' => $this->faker->randomElement(Voucher::TYPES),
            'discount' => $this->faker->numberBetween(5,20),
            'sign' => '%',
            'product' => $this->faker->randomElement(Product::TYPES)
        ];
    }
}
