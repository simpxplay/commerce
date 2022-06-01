<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\BasketRequest;
use App\Services\BasketService;

class BasketController extends Controller
{
    public function calculateBasket(BasketRequest $request, BasketService $service): array
    {
        return $service->calculate($request->validated());
    }
}
