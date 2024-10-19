<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Initialize order total
        $orderTotal = 0;
        $productsToAttach = [];

        foreach ($request->input('products') as $productData) {
            $product = Product::findOrFail($productData['id']);

            if ($product->quantity < $productData['quantity']) {
                return response()->json(['error' => 'Not enough stock for product: ' . $product->name], 422);
            }

            $orderTotal += $product->price * $productData['quantity'];

            $productsToAttach[] = [
                'product_id' => $productData['id'],
                'quantity' => $productData['quantity'],
            ];

            $product->decrement('quantity', $productData['quantity']);
        }

        $order = Order::create([
            'total' => $orderTotal,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
        ]);

        $order->products()->attach($productsToAttach);


        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = Order::with('products')
            ->where('id', $id)
            ->where('customer_email', auth()->user()->email)
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json($order, 200);
    }

}
