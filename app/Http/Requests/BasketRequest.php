<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_ids' => [
                'required',
                'array'
            ],
            'product_ids.*' => [
                'required',
                'integer',
                'exists:products,id'
            ],
            'voucher_codes' => [
                'sometimes',
                'array'
            ],
            'voucher_codes.*' => [
                'sometimes',
                'string',
                'exists:vouchers,code'
            ]
        ];
    }
}
