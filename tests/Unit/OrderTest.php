<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{

    use RefreshDatabase;

    public function it_can_create_an_order()
    {
        // Create a product
        $product = Product::create([
            'name' => 'Test Product',
            'price' => 100.00,
            'quantity' => 50,
        ]);

        $orderData = [
            'total' => 200.00,
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
        ];

        $order = Order::create($orderData);
        $order->products()->attach([$product->id => ['quantity' => 2]]);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals('John Doe', $order->customer_name);
    }
}
