<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Reset auto-increment IDs for tables
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1');
    }

    /**
     * Test get products list success.
     *
     * @return void
     */
    public function test_get_products_list_success()
    {
        $response = $this->getJson('/products');
        $response->assertStatus(200);
    }

    /**
     * Test get product by id success.
     *
     * @return void
     */
    public function test_get_product_by_id_success()
    {
        $categoryData = [
            'name' => 'Category 1',
        ];
        Category::create($categoryData);

        $productData = [
            'name' => 'Product 1',
            'category_id' => 1,
            'category_name' => 'Category 1',
            'short_description' => 'Product 1 description',
            'long_description' => 'Product 1 description',
            'price' => 10.99,
            'stock' => 23
        ];
        Product::create($productData);

        $response = $this->getJson('/product/1');
        $response->assertStatus(200);
    }

    /**
     * Test get product by id failure (not found).
     *
     * @return void
     */
    public function test_get_product_by_id_not_found_error()
    {
        $response = $this->getJson('/product/567');
        $response->assertStatus(404);
    }

    /**
     * Test get product list by category with items success.
     *
     * @return void
     */
    public function test_get_product_list_by_category_with_items_success()
    {
        $categoryData = [
            'name' => 'Category 1',
        ];
        Category::create($categoryData);

        $productData = [
            'name' => 'Product 1',
            'category_id' => 1,
            'category_name' => 'Category 1',
            'short_description' => 'Product 1 description',
            'long_description' => 'Product 1 description',
            'price' => 10.99,
            'stock' => 23
        ];
        Product::create($productData);

        $response = $this->getJson('/products/1');
        $response->assertStatus(200);
    }

    /**
     * Test get product list by an empty category success.
     *
     * @return void
     */
    public function test_get_product_list_by_category_without_items_success()
    {
        $categoryData = [
            'name' => 'Category 1',
        ];
        Category::create($categoryData);

        $response = $this->getJson('/products/1');
        $response->assertStatus(200);
    }

    /**
     * Test get product list by category failure (not found).
     *
     * @return void
     */
    public function test_get_product_list_by_category_not_found_error()
    {
        $response = $this->getJson('/products/567');
        $response->assertStatus(404);
    }

}
