<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $productData = [
            'name' => 'Test Product',
            'price' => 100.00,
            'quantity' => 50,
        ];

        $product = Product::create($productData);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals(100.00, $product->price);
        $this->assertEquals(50, $product->quantity);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = Product::create([
            'name' => 'Test Product',
            'price' => 100.00,
            'quantity' => 50,
        ]);

        $product->update(['name' => 'Updated Product']);

        $this->assertEquals('Updated Product', $product->name);
    }

}
