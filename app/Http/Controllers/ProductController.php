<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     *  Get Products include  (Search - filter)
     */
    public function index(Request $request)
    {

        $searchTerm = $request->input('search');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $perPage = $request->input('per_page', 10);

        $cacheKey = "products.search.{$searchTerm}.{$minPrice}.{$maxPrice}.perPage.{$perPage}";

        // Check the cache for the products, or execute the query if not cached
        $products = Cache::remember($cacheKey, 60, function () use ($searchTerm, $minPrice, $maxPrice, $perPage) {
            return Product::search($searchTerm, $minPrice, $maxPrice)
                ->paginate($perPage);
        });

        return view('products.index', compact('products'));

    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);


        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'quantity' => 'sometimes|required|integer|min:0',
            'description' => 'nullable|string',
        ]);


        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!'); // Redirect to index
    }


}
