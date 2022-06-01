<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(3)->sequence(
            [
                'name' => 'Product A',
                'price' => 10,
                'type' => Product::TYPE_A
            ],
            [
                'name' => 'Product B',
                'price' => 8,
                'type' => Product::TYPE_B
            ],
            [
                'name' => 'Product C',
                'price' => 12,
                'type' => Product::TYPE_C
            ],
        )->create();
    }
}
