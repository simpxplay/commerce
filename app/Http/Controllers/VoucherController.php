<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\VoucherCollection;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function index(): VoucherCollection
    {
        return new VoucherCollection(Voucher::query()->paginate());
    }
}
