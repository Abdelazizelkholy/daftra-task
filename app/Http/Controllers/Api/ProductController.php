<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = Product::query();

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $products = $query->paginate($perPage);

        return response()->json($products, 200);
    }
}
