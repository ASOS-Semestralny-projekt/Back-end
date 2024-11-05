<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Rules\ValidOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Please log in'
            ])->setStatusCode(401);
        }

        $totalPrice = $request->input('total_price');


        try {
            $data = $request->validate([
                'productsInOrder' => ['required', 'array', new ValidOrder($totalPrice)],
                'productsInOrder.*.id' => 'required|integer',
                'productsInOrder.*.quantity' => 'required|integer|min:1',
                'productsInOrder.*.price' => 'required|numeric|min:0',
                'total_price' => 'required|numeric|min:0',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->errors()
            ])->setStatusCode(409);
        }

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => uniqid(),
                'order_date_created' => now(),
                'total_price' => $data['total_price'],
            ]);

            foreach ($data['productsInOrder'] as $product) {
                $order->products()->attach($product['id'], [
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while placing the order'
            ])->setStatusCode(500);
        }

        return response()->json(['message' => 'Order placed successfully'], 201);
    }

    public function getOrders()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Please log in'
            ])->setStatusCode(401);
        }

        $orders = auth()->user()->orders()->with('products')->get();

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
