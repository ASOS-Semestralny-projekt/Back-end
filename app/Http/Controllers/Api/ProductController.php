<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Return products that somehow match the search query if any.
     * Else return all products.
     *
     * @param Request $request
     * @return JsonResponse
     */
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

        return response()->json($products)->setStatusCode(200);
    }

    /**
     * Return products that belong to a specific category.
     *
     * @param $categoryId
     * @return JsonResponse
     */
    public function getByCategory($categoryId): JsonResponse
    {
        if(!Category::find($categoryId)) {
            return response()->json([
                'message' => 'No products found for this category',
                'error' => 'Searched category does not exist'],
                404);
        }

        $products = Product::where('category_id', $categoryId)->get();

        return response()->json($products)->setStatusCode(200);
    }

    /**
     * Return a specific product.
     *
     * @param $productId
     * @return JsonResponse
     */
    public function getById($productId): JsonResponse
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
                'error' => 'Searched product does not exist'],
                404);
        }

        return response()->json($product)->setStatusCode(200);
    }

    /**
     * Create a new product.
     *
     * @param Request $request
     * @return JsonResponse
     */
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
