<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::query()->withCount('products')->has('products', '>', 0)->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $products = $category->products()->paginate(20);
        return view('categories.show', compact('category', 'products'));
    }

}
