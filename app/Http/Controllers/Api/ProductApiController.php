<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::with('category')->where('stock', '>', 0)->orderBy('name')->get();

        return ProductResource::collection($products)->response();
    }
}
