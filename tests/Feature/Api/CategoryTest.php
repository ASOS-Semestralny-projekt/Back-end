<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CategoryTest extends TestCase
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

    /**
     * Test get categories list.
     *
     * @return void
     */
    public function test_get_categories_list_success(): void
    {
        $this->refreshForTests();
        $response = $this->getJson('/categories');
        $response->assertStatus(200);
    }
}
