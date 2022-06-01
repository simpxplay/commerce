<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(): ProductCollection
    {
        return new ProductCollection(Product::query()->paginate());
    }
}
