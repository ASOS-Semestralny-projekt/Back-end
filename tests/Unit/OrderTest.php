<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating an order.
     */
    public function test_create_order(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $orderData = [
            'user_id' => $user->id,
            'order_number' => 'ORD123',
            'order_date_created' => now(),
            'total_price' => 10.99,
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
            'products' => [
                [
                    'id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price
                ]
            ]
        ];

        $order = Order::create($orderData);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals(10.99, $order->total_price);
        $this->assertDatabaseHas('order_product', ['product_id' => $product->id, 'quantity' => 1]);
    }

    /**
     * Test creating an order with multiple products.
     */
    public function test_create_order_with_multiple_products(): void
    {
        $user = User::factory()->create();
        $product1 = Product::factory()->create(['price' => 10.00]);
        $product2 = Product::factory()->create(['price' => 5.00]);

        $orderData = [
            'user_id' => $user->id,
            'order_number' => 'ORD125',
            'order_date_created' => now(),
            'total_price' => 25.00,
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
            'products' => [
                [
                    'id' => $product1->id,
                    'quantity' => 2,
                    'price' => $product1->price
                ],
                [
                    'id' => $product2->id,
                    'quantity' => 1,
                    'price' => $product2->price
                ]
            ]
        ];

        $order = Order::create($orderData);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals(25.00, $order->total_price);
        $this->assertDatabaseHas('order_product', ['product_id' => $product1->id, 'quantity' => 2]);
        $this->assertDatabaseHas('order_product', ['product_id' => $product2->id, 'quantity' => 1]);
    }
}
