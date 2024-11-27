<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_products_list_success()
    {
        Product::factory()->count(1)->create();
        $response = $this->getJson('/products');
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    public function test_get_product_by_id_success()
    {
        $product = Product::factory()->create();
        $uri = '/product/' . $product->id;
        $response = $this->getJson($uri);
        $response->assertStatus(200);
        $response->assertJson($product->toArray());
    }

    public function test_get_product_by_id_not_found_error()
    {
        $this->getJson('/product/999')->assertStatus(404);
    }

    public function test_get_product_list_by_category_with_items_success()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $product2 = Product::factory()->create(['category_id' => $category->id]);
        $uri = '/products/' . $category->id;
        $response = $this->getJson($uri);
        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJson([$product->toArray(), $product2->toArray()]);
    }

    public function test_get_product_list_by_category_without_items_success()
    {
        $category = Category::factory()->create();
        $uri = '/products/' . $category->id;
        $response = $this->getJson($uri);
        $response->assertStatus(200);
        $response->assertJsonCount(0);
        $response->assertJson([]);
    }

    public function test_get_product_list_by_category_not_found_error()
    {
        $this->getJson('/products/999')->assertStatus(404);
    }
}
