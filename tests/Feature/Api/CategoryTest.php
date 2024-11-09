<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test get categories list.
     *
     * @return void
     */
    public function test_get_categories_list_success(): void
    {
        $response = $this->getJson('/categories');
        $response->assertStatus(200);
    }
}
