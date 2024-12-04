<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a product.
     */
    public function test_create_product(): void
    {

        $product = Product::factory()->create(['name' => 'Sample Product']);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Sample Product', $product->name);
        $this->assertDatabaseHas('products', ['name' => 'Sample Product']);
    }

    /**
     * Test creating a product, mock.
     */
    public function test_create_product_mock()
    {
        $product = $this->createMock(Product::class);
        $product->method('save')
            ->willReturn(true);

        $this->assertTrue($product->save());
    }

    /**
     * Test finding a product by its ID.
     */
    public function test_find_product_by_id(): void
    {
        $product = Product::factory()->create();

        $foundProduct = Product::find($product->id);

        $this->assertInstanceOf(Product::class, $foundProduct);
        $this->assertEquals($product->id, $foundProduct->id);
    }

    /**
     * Test truncating products.
     */
    public function test_truncate_products(): void
    {
        Product::factory()->create(['name' => 'Sample Product']);

        Product::truncate();

        $this->assertDatabaseMissing('products', ['name' => 'Sample Product']);
    }
}
