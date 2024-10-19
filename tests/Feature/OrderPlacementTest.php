<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderPlacementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_place_an_order()
    {
        $user = User::factory()->create([
        ]);

        // Create a product to order
        $product = Product::create([
            'name' => 'Test Product',
            'price' => 100.00,
            'quantity' => 10,
        ]);

        $response = $this->actingAs($user)
            ->postJson('/api/orders', [
                'customer_name' => 'John Doe',
                'customer_email' => 'john@example.com',
                'products' => [
                    [
                        'id' => $product->id,
                        'quantity' => 2,
                    ],
                ],
            ]);


        $response->assertStatus(201);
        $this->assertDatabaseHas('orders', [
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'total' => 200.00,
        ]);


        $product->refresh();
        $this->assertEquals(8, $product->quantity);
    }



}
