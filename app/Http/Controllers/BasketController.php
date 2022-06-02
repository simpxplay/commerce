<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\BasketRequest;
use App\Services\BasketService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BasketController extends Controller
{
    public function calculateBasket(BasketRequest $request, BasketService $service): JsonResponse
    {
        return response()->json($service->calculate($request->validated()), Response::HTTP_OK);
    }
}
