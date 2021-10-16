<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{

    public function __invoke()
    {
        $products = Product::query()->limit(10)->with('category')->inRandomOrder()->get();
        $categories = Category::query()->limit(4)->inRandomOrder()->get();

        return view('home', compact('products', 'categories'));
    }
}
