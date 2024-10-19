<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'New Product',
            'price' => 150.00,
            'quantity' => 20,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('products', ['name' => 'New Product']);
    }

    /** @test */
    public function it_can_list_products()
    {
        Product::factory()->count(5)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }
}
