<?php

namespace Tests\Feature\Auth;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use function Laravel\Prompts\password;

class AuthRoutesTest extends TestCase
{

    use RefreshDatabase;

    private function registerUser($password = 'password', $missing = false)
    {
        $data = [
            'first_name' => 'Jožko',
            'last_name' => 'Mrkvička',
            'street' => 'Ilkovičova',
            'house_number' => '11B',
            'city' => 'Bratislava',
            'zip_code' => '82103',
            'country' => 'Slovensko',
            'phone' => '421914567890',
            'password' => $password
        ];

        if (!$missing) {
            $data['email'] = 'example@example.com';
        }

        return $this->postJson('/register', $data);
    }

    private function logoutUser()
    {
        return $this->getJson('/logout');
    }

    private function loginUser($email='example@example.com',$password = 'password')
    {
        return $this->postJson('/login', [
            'email' => $email,
            'password' => $password
        ]);
    }

    public function test_register_user_success()
    {
        $response = $this->registerUser();

        $this->assertDatabaseHas('users', ['email' => 'example@example.com']);
        $response->assertStatus(201);
    }

    public function test_register_user_weak_password_error()
    {
        $response = $this->registerUser(password: 'weak');
        $response->assertStatus(400);
    }

    public function test_register_user_email_exists_error()
    {
        $this->registerUser();
        $response2 = $this->registerUser();
        $response2->assertStatus(400);
    }

    public function test_register_user_missing_required_field_error()
    {
        $response = $this->registerUser(missing: true);
        $response->assertStatus(400);
    }

    public function test_login_user_success()
    {
        $this->registerUser();
        $this->logoutUser();
        $response = $this->loginUser();

        $response->assertStatus(200);
        $response->assertJsonFragment(['first_name' => 'Jožko']);
        $response->assertJsonFragment(['last_name' => 'Mrkvička']);
    }

    public function test_login_user_wrong_password_error()
    {
        $this->registerUser();
        $this->logoutUser();
        $response = $this->loginUser(password:'wrongPassword');

        $response->assertStatus(400);
    }

    public function test_login_user_wrong_email_error()
    {
        $this->registerUser();
        $this->logoutUser();
        $response = $this->loginUser(email: 'wrongEmail@email.com');

        $response->assertStatus(400);
    }

    public function test_login_user_already_logged_in_error()
    {
        $this->registerUser();
        $this->logoutUser();
        $this->loginUser();
        $response = $this->loginUser();

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
