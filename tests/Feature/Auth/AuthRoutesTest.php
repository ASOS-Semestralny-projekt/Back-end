<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user registration success.
     *
     * @return void
     */
    public function test_register_user_success()
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

        $response->assertStatus(201);
    }

    /**
     * Test user registration failure (validation error).
     *
     * @return void
     */
    public function test_register_user_weak_password_error()
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
            'password' => 'short'
        ];

        $response = $this->postJson('/register', $userData);

        $response->assertStatus(400);
    }

    /**
     * Test user register failure (email already exists).
     *
     * @return void
     */
    public function test_register_user_email_exists_error()
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

        $this->postJson('/register', $userData);

        $response = $this->postJson('/register', $userData);

        $response->assertStatus(400);
    }

    /**
     * Test user register failure (missing required field).
     *
     * @return void
     */
    public function test_register_user_missing_required_field_error()
    {
        $userData = [
            'first_name' => 'Jožko',
            'last_name' => 'Mrkvička',
            'street' => 'Ilkovičova',
            'house_number' => '11B',
            'city' => 'Bratislava',
            'zip_code' => '82103',
            'country' => 'Slovensko'
        ];

        $this->postJson('/register', $userData)
            ->assertStatus(400);
    }

    /**
     * Test user login success.
     *
     * @return void
     */
    public function test_login_user_success()
    {
        $userData = [
            'email' => 'example@example.com',
            'password' => 'password'
        ];

        $this->postJson('/register', [
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
        ]);

        $response = $this->getJson('/logout');
        $response = $this->postJson('/login', $userData);
        $response->assertStatus(200);
    }

    /**
     * Test user login failure (wrong password).
     *
     * @return void
     */
    public function test_login_user_wrong_password_error()
    {
        $userData = [
            'email' => 'example@example.com',
            'password' => 'asdf'
        ];

        $this->postJson('/register', [
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
        ]);

        $response = $this->getJson('/logout');
        $response = $this->postJson('/login', $userData);
        $response->assertStatus(400);
    }

    /**
     * Test user login failure (wrong email).
     *
     * @return void
     */
    public function test_login_user_wrong_email_error()
    {
        $userData = [
            'email' => 'wrongExample@example.com',
            'password' => 'password'
        ];

        $this->postJson('/register', [
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
        ]);

        $response = $this->getJson('/logout');
        $response = $this->postJson('/login', $userData);
        $response->assertStatus(400);
    }

    /**
     * Test user login failure (user already logged in).
     *
     * @return void
     */
    public function test_login_user_already_logged_in_error()
    {
        $userData = [
            'email' => 'example@example.com',
            'password' => 'password'
        ];

        $this->postJson('/register', [
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
        ]);

        $response = $this->getJson('/logout');
        $response = $this->postJson('/login', $userData);
        $response = $this->postJson('/login', $userData);
        $response->assertStatus(400);
    }

    /**
     * Test user logout success.
     *
     * @return void
     */
    public function test_logout_user_success()
    {
        $this->postJson('/register', [
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
        ]);

        $response = $this->getJson('/logout');
        $response->assertStatus(200);
    }

    /**
     * Test user logout failure (user not logged in).
     *
     * @return void
     */
    public function test_logout_user_not_logged_in_error()
    {
        $response = $this->getJson('/logout');
        $response->assertStatus(401);
    }
}
