<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CategoryTest    /**
     * Test get orders list success.
     */ extends TestCase
{
    use RefreshDatabase;

    /**
     * Test get categories list.
     */
    public function test_get_categories_list_success(): void
    {
        Category::create(['name' => 'Category 1']);
        Category::create(['name' => 'Category 2']);

        $response = $this->getJson('/categories');
        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJson([
            ['name' => 'Category 1'],
            ['name' => 'Category 2']
        ]);
    }
}
