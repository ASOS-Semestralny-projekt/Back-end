<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Rules\ValidOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Place an order.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function placeOrder(Request $request): JsonResponse
    {
        Log::info('Placing an order', ['user_id' => auth()->id()]);

        try {
            $totalPrice = $request->input('total_price');

            $data = $request->validate([
                'productsInOrder' => ['required', 'array', new ValidOrder($totalPrice)],
                'productsInOrder.*.id' => 'required|integer',
                'productsInOrder.*.quantity' => 'required|integer|min:1',
                'productsInOrder.*.price' => 'required|numeric|min:0',
                'total_price' => 'required|numeric|min:0',
            ]);

            Log::info('Order data validated successfully', ['data' => $data]);
        } catch (Exception $e) {
            Log::error('Order validation failed', ['error' => $e->getMessage()]);

            if ($e instanceof ValidationException) {
                return response()->json([
                    'message' => 'Order failed',
                    'errors' => $e->errors(),
                ])->setStatusCode($e->status);
            }
        }

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => uniqid(),
                'order_date_created' => now(),
                'total_price' => $data['total_price'],
            ]);

            Log::info('Order created successfully', ['order_id' => $order->id]);

            // Map the products to the order in the order_products table
            foreach ($data['productsInOrder'] as $product) {
                $order->products()->attach($product['id'], [
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                ]);
            }

            Log::info('Products attached to order', ['order_id' => $order->id, 'products' => $data['productsInOrder']]);
        } catch (Exception $e) {
            Log::error('Order creation failed', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => 'Order failed',
                'errors' => $e->getMessage(),
            ])->setStatusCode(500);
        }

        return response()->json(['message' => 'Order placed successfully'], 201);
    }

    /**
     * Get all orders for the authenticated user.
     *
     * @return JsonResponse
     */
    public function getOrders(): JsonResponse
    {
        $user = auth()->user();

        Log::info('Fetching orders for user', ['user_id' => auth()->id()]);

        $orders = $user->orders()->with('products')->get();

        Log::info('Orders fetched successfully', ['orders_count' => $orders->count()]);

        return response()->json($orders->map(function ($order) {
            return [
                'order_number' => $order->order_number,
                'order_date_created' => $order->created_at->format('d-m-Y'),
                'products' => $order->products->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'img_path' => $product->img_path,
                    ];
                }),
                'total_price' => $order->total_price,
            ];
        }))->setStatusCode(200);
    }
}
