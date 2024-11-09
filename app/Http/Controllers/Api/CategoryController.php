<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Return all categories.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        Log::info('Fetching all categories');

        $categories = Category::all();

        Log::info('Categories fetched successfully', ['categories_count' => $categories->count()]);

        return response()->json($categories)->setStatusCode(200);
    }
}
