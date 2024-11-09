<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Get sample user data.
     *
     * @param array $overrides
     * @return array
     */
    private function getUserData(array $overrides = []): array
    {
        return array_merge([
            'first_name' => 'Jožko',
            'last_name' => 'Mrkvička',
            'street' => 'Ilkovičova',
            'house_number' => '11B',
            'city' => 'Bratislava',
            'zip_code' => '82103',
            'country' => 'Slovensko',
            'email' => 'example@example.com',
            'phone' => '421914567890',
            'password' => 'password',
        ], $overrides);
    }

    /**
     * Register a user.
     *
     * @param array $overrides
     * @return \Illuminate\Testing\TestResponse
     */
    private function registerUser(array $overrides = [])
    {
        return $this->postJson('/register', $this->getUserData($overrides));
    }

    /**
     * Test get user success.
     */
    public function test_get_user_success(): void
    {
        $this->registerUser();
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
