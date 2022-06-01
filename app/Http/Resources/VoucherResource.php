<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "code" => $this->code,
            "type" => $this->type,
            "discount" => $this->discount,
            "sign" => $this->sign,
            "product" => $this->product,
        ];
    }
}
