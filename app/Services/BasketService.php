<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Models\Voucher;

class BasketService
{
    public function calculate(array $data): array
    {
        $vouchers = Voucher::whereIn('code', $data['voucher_codes'])->get();
        $productsCounts = array_count_values($data['product_ids']);
        $products = Product::whereIn('id', $data['product_ids'])
            ->get();
        $productsGroupedByType = $products->groupBy('type');
        $productSum = $products->map(function ($item) use ($productsCounts) {
            return $item->price * $productsCounts[$item->id];
        })->sum();

        $usedTypes = [];
        $resultVouchers = [];
        foreach ($vouchers as $voucher) {
            if (!in_array($voucher->type, $usedTypes)) {
                $usedTypes[] = $voucher->type;
                $resultVouchers[] = $voucher->toArray();

                switch ($voucher->type) {
                    case Voucher::TYPE_V:
                        $products = $productsGroupedByType[$voucher->product];
                        foreach ($products as $key => $product) {
                            $usedForCount = intdiv($productsCounts[$product->id], 2);
                            if ($usedForCount) {
                                $productSum -= $usedForCount * $this->calculateDiscount($product->price, $voucher);
                            }
                        }
                        break;
                    case Voucher::TYPE_R:
                        $products = $productsGroupedByType[$voucher->product];
                        foreach ($products as $product) {
                            $productSum -= $this->calculateDiscount($product->price, $voucher);
                        }
                        break;
                    case Voucher::TYPE_S:
                        if ($voucher->product < $productSum) {
                            $productSum -= $this->calculateDiscount($productSum, $voucher);
                        }
                }
            }
        }
        return [
            'total' => max($productSum, 0),
            'products' => $products->map(
                function ($item) use ($productsCounts) {
                    return [$productsCounts[$item->id] => $item];
                }
            )->
            toArray(),
            'vouchers' => $resultVouchers
        ];
    }

    private function calculateDiscount($price, $voucher)
    {
        if ($voucher->sign === '%') {
            $result = (($price / 100) * $voucher->discount);
        } else {
            $result = $voucher->discount;
        }
        return $result;
    }
}
