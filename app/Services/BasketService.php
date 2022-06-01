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
        $productSum = Product::whereIn('id', $data['product_ids'])
            ->get()
            ->map(function ($item) use ($productsCounts) {
                return $item->price * $productsCounts[$item->id];
            })->sum();

        $usedTypes = [];
        $resultVouchers = [];
        $voucherSum = 0.0;
        foreach ($vouchers as $voucher) {
            if (!in_array($voucher->type, $usedTypes)) {
                $usedTypes[] = $voucher->type;
                $resultVouchers[] = $voucher->toArray();

                if ($voucher->type === Voucher::TYPE_V) {
                    $products = Product::whereIn('id', $data['product_ids'])
                        ->where('type', $voucher->product)
                        ->get();
                    foreach ($products as $key => $product) {
                        $usedForCount = intdiv($productsCounts[$product->id], 2);
                        if ($usedForCount) {
                            if ($voucher->sign === '%') {
                                $voucherSum += $usedForCount * (($product->price / 100) * $voucher->discount);
                            } else {
                                $voucherSum += $usedForCount * ($product->price - $voucher->discount);
                            }
                        }
                    }
                } elseif ($voucher->type === Voucher::TYPE_R) {
                    $products = Product::whereIn('id', $data['product_ids'])
                        ->where('type', $voucher->product)
                        ->get();
                    foreach ($products as $product) {
                        if ($voucher->sign === '%') {
                            $voucherSum += (($product->price / 100) * $voucher->discount);
                        } else {
                            $voucherSum += $product->price - $voucher->discount;
                        }
                    }
                } elseif ($voucher->type === Voucher::TYPE_S) {
                    if ($voucher->product < $productSum) {
                        if ($voucher->sign === '%') {
                            $voucherSum += (($productSum / 100) * $voucher->discount);
                        } else {
                            $voucherSum += $productSum - $voucher->discount;
                        }
                    }
                }
            }
        }
        $total = $productSum - $voucherSum;
        return [
            'total' => $total < 0 ? 0 : $total,
            'products' => Product::whereIn('id', $data['product_ids'])->get()->map(
                function ($item) use ($productsCounts) {
                    return [$productsCounts[$item->id] => $item];
                }
            )->toArray(),
            'vouchers' => $resultVouchers
        ];
    }
}
