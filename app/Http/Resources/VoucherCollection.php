<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Voucher;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VoucherCollection extends ResourceCollection
{
    public $collection = Voucher::class;
}
