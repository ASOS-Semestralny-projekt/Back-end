<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_products_list_success()
    {
        $this->getJson('/products')->assertStatus(200);
    }

    public function test_get_product_by_id_success()
    {
        Category::create(['name' => 'Category 1']);
        Product::create([
            'name' => 'Product 1',
            'category_id' => 1,
            'category_name' => 'Category 1',
            'short_description' => 'Product 1 description',
            'long_description' => 'Product 1 description',
            'price' => 10.99,
            'stock' => 23
        ]);

        $this->getJson('/product/1')->assertStatus(200);
    }

    public function test_get_product_by_id_not_found_error()
    {
        $this->getJson('/product/567')->assertStatus(404);
    }

    public function test_get_product_list_by_category_with_items_success()
    {
        Category::create(['name' => 'Category 1']);
        Product::create([
            'name' => 'Product 1',
            'category_id' => 1,
            'category_name' => 'Category 1',
            'short_description' => 'Product 1 description',
            'long_description' => 'Product 1 description',
            'price' => 10.99,
            'stock' => 23
        ]);

        $this->getJson('/products/2')->assertStatus(200);
    }

    public function test_get_product_list_by_category_without_items_success()
    {
        Category::create(['name' => 'Category 1']);
        $this->getJson('/products/3')->assertStatus(200);
    }

    public function test_get_product_list_by_category_not_found_error()
    {
        $this->getJson('/products/567')->assertStatus(404);
    }
}
