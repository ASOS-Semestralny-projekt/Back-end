<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class OrderTest extends TestCase
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

    public function test_get_orders_list_success(): void
    {
        $this->registerUser();

        $response = $this->getJson('/orders');
        $response->assertStatus(200);
        $response->assertJson([]);
    }

    public function test_get_orders_list_not_logged_in_error(): void
    {
        $response = $this->getJson('/orders');
        $response->assertStatus(401);
    }

    public function test_create_order_success(): void
    {
        $this->registerUser();

        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'category_name' => $category->name,
            'price' => 10.99
        ]);
        $orderData = [
            'customer' => [
                'first_name' => 'Jožko',
                'last_name' => 'Mrkvička',
                'street' => 'Ilkovičova',
                'house_number' => '11B',
                'city' => 'Bratislava',
                'zip_code' => '82103',
                'country' => 'Slovensko',
                'email' => 'example@example.com',
                'phone' => '421914567890'
            ],
            'productsInOrder' => [
                [
                    'id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price
                ]
            ],
            'total_price' => $product->price
        ];

        $response = $this->postJson('/place-order', $orderData);
        $response->assertStatus(201);
    }

    public function test_create_order_not_logged_in_success(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'category_name' => $category->name,
            'price' => 10.99
        ]);
        $orderData = [
            'customer' => [
                'first_name' => 'Jožko',
                'last_name' => 'Mrkvička',
                'street' => 'Ilkovičova',
                'house_number' => '11B',
                'city' => 'Bratislava',
                'zip_code' => '82103',
                'country' => 'Slovensko',
                'email' => 'example@example.com',
                'phone' => '421914567890'
            ],
            'productsInOrder' => [
                [
                    'id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price
                ]
            ],
            'total_price' => $product->price
        ];

        $response = $this->postJson('/place-order', $orderData);
        $response->assertStatus(201);
    }

    public function test_create_order_product_does_not_exist_error(): void
    {
        $this->registerUser();

        $orderData = [
            'customer' => [
                'first_name' => 'Jožko',
                'last_name' => 'Mrkvička',
                'street' => 'Ilkovičova',
                'house_number' => '11B',
                'city' => 'Bratislava',
                'zip_code' => '82103',
                'country' => 'Slovensko',
                'email' => 'example@example.com',
                'phone' => '421914567890'
            ],
            'productsInOrder' => [
                [
                    'id' => 1,
                    'quantity' => 1,
                    'price' => 10.99
                ]
            ],
            'total_price' => 10.99
        ];

        $response = $this->postJson('/place-order', $orderData);
        $response->assertStatus(404);
    }

    public function test_create_order_product_price_not_correct_error(): void
    {
        $this->registerUser();

        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'category_name' => $category->name,
            'price' => 10.99
        ]);

        $orderData = [
            'customer' => [
                'first_name' => 'Jožko',
                'last_name' => 'Mrkvička',
                'street' => 'Ilkovičova',
                'house_number' => '11B',
                'city' => 'Bratislava',
                'zip_code' => '82103',
                'country' => 'Slovensko',
                'email' => 'example@example.com',
                'phone' => '421914567890'
            ],
            'productsInOrder' => [
                [
                    'id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price
                ]
            ],
            'total_price' => $product->price + 1
        ];

        $response = $this->postJson('/place-order', $orderData);
        $response->assertStatus(409);
    }

}
