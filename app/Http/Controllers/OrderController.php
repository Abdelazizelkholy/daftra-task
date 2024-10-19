<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::paginate(10);
        return view('orders.index', compact('orders'));
    }


    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Initialize order total
        $orderTotal = 0;
        $productsToAttach = [];


        foreach ($validated['products'] as $productData) {
            $product = Product::findOrFail($productData['id']);

            if ($product->quantity < $productData['quantity']) {
                return redirect()->back()->withErrors(['error' => 'Not enough stock for product: ' . $product->name]);
            }

            // Calculate total
            $orderTotal += $product->price * $productData['quantity'];

            // Prepare to attach product to order
            $productsToAttach[] = [
                'product_id' => $productData['id'],
                'quantity' => $productData['quantity'],
            ];


            $product->decrement('quantity', $productData['quantity']);
        }


        $order = Order::create([
            'total' => $orderTotal,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
        ]);


        $order->products()->attach($productsToAttach);

        event(new OrderPlaced($order));


        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }



}
