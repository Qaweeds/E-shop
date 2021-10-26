<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::available()
            ->with('category:name,id')->get(['id', 'category_id', 'title', 'short_description', 'SKU', 'price', 'discount', 'in_stock']);

        return response()->json(compact('products'));
    }

    public function show($id){
        $product = Product::with('category:name,id')->findOrFail($id);

        return response()->json(compact('product'));
    }
}
