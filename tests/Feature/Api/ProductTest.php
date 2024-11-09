<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductTest extends TestCase
{
    private function refreshForTests(): void
    {
        Product::truncate();
        Category::truncate();
        User::truncate();
        Order::truncate();
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1');
    }

    public function test_get_products_list_success()
    {
        $this->refreshForTests();
        $this->getJson('/products')->assertStatus(200);
    }

    public function test_get_product_by_id_success()
    {
        $this->refreshForTests();
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
        $this->refreshForTests();
        $this->getJson('/product/1')->assertStatus(404);
    }

    public function test_get_product_list_by_category_with_items_success()
    {
        $this->refreshForTests();
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

        $this->getJson('/products/1')->assertStatus(200);
    }

    public function test_get_product_list_by_category_without_items_success()
    {
        $this->refreshForTests();
        Category::create(['name' => 'Category 1']);
        $this->getJson('/products/1')->assertStatus(200);
    }

    public function test_get_product_list_by_category_not_found_error()
    {
        $this->refreshForTests();
        $this->getJson('/products/1')->assertStatus(404);
    }
}
