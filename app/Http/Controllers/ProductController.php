<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('short_description', 'like', "%{$search}%")
                ->orWhere('long_description', 'like', "%{$search}%")
                ->orWhere('category_name', 'like', "%{$search}%");
        }

        $products = $query->get();

        return response()->json($products);
    }
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'category_name' => 'required|integer',
            'image_path' => 'nullable|image|max:2048',
            'short_description' => 'string',
            'long_description' => 'string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',

        ]);

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'category_name' => $request->category_name,
            'image_path' => $request->image_path,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return response()->json(['message' => 'Product created successfully']);
    }
}
