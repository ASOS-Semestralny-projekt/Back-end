<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test get user success.
     */
    public function test_get_user_success(): void
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
        $response = $this->getJson('/user');
        $response->assertStatus(200);
    }

    /**
     * Test get user failure (not logged in).
     */
    public function test_get_user_not_logged_in_error(): void
    {
        $response = $this->getJson('/user');
        $response->assertStatus(401);
    }
}
