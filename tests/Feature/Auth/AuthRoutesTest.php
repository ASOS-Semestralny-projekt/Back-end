<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRoutesTest extends TestCase
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
     * Logout a user.
     *
     * @return \Illuminate\Testing\TestResponse
     */
    private function logoutUser()
    {
        return $this->getJson('/logout');
    }

    public function test_register_user_success()
    {
        $response = $this->registerUser();

        $this->assertDatabaseHas('users', ['email' => 'example@example.com']);
        $response->assertStatus(201);
    }

    public function test_register_user_weak_password_error()
    {
        $response = $this->registerUser(['password' => 'short']);
        $response->assertStatus(400);
    }

    public function test_register_user_email_exists_error()
    {
        $this->registerUser();
        $response = $this->registerUser();
        $response->assertStatus(400);
    }

    public function test_register_user_missing_required_field_error()
    {
        $response = $this->registerUser(['email' => null]);
        $response->assertStatus(400);
    }

    public function test_login_user_success()
    {
        $this->registerUser();
        $this->logoutUser();

        $response = $this->postJson('/login', [
            'email' => 'example@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_login_user_wrong_password_error()
    {
        $this->registerUser();
        $this->logoutUser();

        $response = $this->postJson('/login', [
            'email' => 'example@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(400);
    }

    public function test_login_user_wrong_email_error()
    {
        $this->registerUser();
        $this->logoutUser();

        $response = $this->postJson('/login', [
            'email' => 'wrong@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(400);
    }

    public function test_login_user_already_logged_in_error()
    {
        $this->registerUser();
        $this->logoutUser();

        $this->postJson('/login', [
            'email' => 'example@example.com',
            'password' => 'password',
        ]);

        $response = $this->postJson('/login', [
            'email' => 'example@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(400);
    }

    public function test_logout_user_success()
    {
        $this->registerUser();
        $response = $this->logoutUser();

        $response->assertStatus(200);
    }

    public function test_logout_user_not_logged_in_error()
    {
        $response = $this->logoutUser();
        $response->assertStatus(401);
    }
}
