<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();
        $categories->makeHidden(['created_at', 'updated_at']);

        return response()->json($categories)->setStatusCode(200);
    }
}
