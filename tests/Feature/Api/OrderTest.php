<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class OrderTest extends TestCase
{
    private function refreshForTests(): void
    {
        Product::truncate();
        Category::truncate();
        User::truncate();
        Order::truncate();
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1');
    }

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
     * Test get orders list success.
     */
    public function test_get_orders_list_success(): void
    {
        $this->refreshForTests();
        $this->registerUser();

        $response = $this->getJson('/orders');
        $response->assertStatus(200);
    }

    /**
     * Test get orders list failure (not logged in).
     */
    public function test_get_orders_list_not_logged_in_error(): void
    {
        $this->refreshForTests();
        $response = $this->getJson('/orders');
        $response->assertStatus(401);
    }

    public function test_create_order_success(): void
    {
        $this->refreshForTests();
        $this->registerUser();

        Category::create(['name' => 'Category 1']);
        Product::create([
            'name' => 'Product 1',
            'category_id' => 1,
            'category_name' => 'Category 1',
            'short_description' => 'Product 1 description',
            'long_description' => 'Product 1 description',
            'price' => 10.99,
            'stock' => 23
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
                    'id' => 1,
                    'quantity' => 1,
                    'price' => 10.99
                ]
            ],
            'total_price' => 10.99
        ];

        $response = $this->postJson('/place-order', $orderData);
        $response->assertStatus(201);
    }

    public function test_create_order_not_logged_in_error(): void
    {
        Category::create(['name' => 'Category 1']);
        Product::create([
            'name' => 'Product 1',
            'category_id' => 1,
            'category_name' => 'Category 1',
            'short_description' => 'Product 1 description',
            'long_description' => 'Product 1 description',
            'price' => 10.99,
            'stock' => 23
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
                    'id' => 1,
                    'quantity' => 1,
                    'price' => 10.99
                ]
            ],
            'total_price' => 10.99
        ];

        $response = $this->postJson('/place-order', $orderData);
        $response->assertStatus(401);
    }

    public function test_create_order_product_does_not_exist_error(): void
    {
        $this->refreshForTests();
        $this->registerUser();

        Category::create(['name' => 'Category 1']);

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
        $this->refreshForTests();
        $this->registerUser();

        Category::create(['name' => 'Category 1']);
        Product::create([
            'name' => 'Product 1',
            'category_id' => 1,
            'category_name' => 'Category 1',
            'short_description' => 'Product 1 description',
            'long_description' => 'Product 1 description',
            'price' => 5.99,
            'stock' => 23
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
                    'id' => 1,
                    'quantity' => 1,
                    'price' => 10.99
                ]
            ],
            'total_price' => 15.99
        ];

        $response = $this->postJson('/place-order', $orderData);
        $response->assertStatus(409);
    }

}
