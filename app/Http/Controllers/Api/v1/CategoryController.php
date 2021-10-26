<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(CategoryCreateRequest $request)
    {
        try {
            Category::create($request->validated());
            return response()->json('Category created');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    public function list(){
        return response()->json(Category::all(['id', 'name']));
    }
}
