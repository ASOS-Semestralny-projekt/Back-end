<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Test get categories list.
     *
     * @return void
     */
    public function test_get_categories_list_success()
    {
        $response = $this->getJson('/categories');
        $response->assertStatus(200);
    }
}
