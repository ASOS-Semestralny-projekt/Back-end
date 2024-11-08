<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test get orders list success.
     */
    public function test_get_orders_list_success(): void
    {
        $userData = [
            'first_name' => 'Jožko',
            'last_name' => 'Mrkvička',
            'street' => 'Ilkovičova',
            'house_number' => '11B',
            'city' => 'Bratislava',
            'zip_code' => '82103',
            'country' => 'Slovensko',
            'email' => 'example@example.com',
            'phone' => '421914567890',
            'password' => 'password'
        ];

        $response = $this->postJson('/register', $userData);
        $response = $this->getJson('/orders');
        $response->assertStatus(200);
    }

    /**
     * Test get orders list failure (not logged in).
     */
    public function test_get_orders_list_not_logged_in_error(): void
    {
        $response = $this->getJson('/orders');
        $response->assertStatus(401);
    }
}
