<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    private function registerUser() : void
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
            'password' => 'password']);
    }

    public function test_get_user_success(): void
    {
        $this->registerUser();
        $response = $this->getJson('/user');
        $response->assertStatus(200);
        $response->assertJson([
            'user' => [
                'first_name' => 'Jožko',
                'last_name' => 'Mrkvička',
                'street' => 'Ilkovičova',
                'house_number' => '11B',
                'city' => 'Bratislava',
                'zip_code' => '82103',
                'country' => 'Slovensko',
                'email' => 'example@example.com',
                'phone' => '421914567890'
            ]
        ]);
    }

    public function test_get_user_not_logged_in_error(): void
    {
        $response = $this->getJson('/user');
        $response->assertStatus(401);
    }
}
