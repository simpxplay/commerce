<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::factory()->count(10)->sequence(
            [
                'type' => Voucher::TYPE_V,
                'discount' => 10,
                'sign' => '%',
                'product' => Product::TYPE_A
            ],
            [
                'type' => Voucher::TYPE_V,
                'discount' => 10,
                'sign' => '%',
                'product' => Product::TYPE_B
            ],
            [
                'type' => Voucher::TYPE_R,
                'discount' => 5,
                'sign' => '$',
                'product' => Product::TYPE_B
            ],
            [
                'type' => Voucher::TYPE_R,
                'discount' => 10,
                'sign' => '$',
                'product' => Product::TYPE_C
            ],
            [
                'type' => Voucher::TYPE_R,
                'discount' => 20,
                'sign' => '%',
                'product' => Product::TYPE_A
            ],
            [
                'type' => Voucher::TYPE_R,
                'discount' => 10,
                'sign' => '%',
                'product' => Product::TYPE_B
            ],
            [
                'type' => Voucher::TYPE_V,
                'discount' => 20,
                'sign' => '%',
                'product' => Product::TYPE_A
            ],
            [
                'type' => Voucher::TYPE_V,
                'discount' => 20,
                'sign' => '%',
                'product' => Product::TYPE_A
            ],
            [
                'type' => Voucher::TYPE_S,
                'discount' => 5,
                'sign' => '%',
                'product' => 40
            ],
            [
                'type' => Voucher::TYPE_S,
                'discount' => 20,
                'sign' => '$',
                'product' => 100
            ],
        )->create();
    }
}
