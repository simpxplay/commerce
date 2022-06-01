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
            'type' => Voucher::TYPE_V,
            'discount' => 10,
            'sign' => '%',
            'product' => Product::TYPE_A
        ];
    }
}
