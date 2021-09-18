<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::query()->paginate(12);

        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        return view('admin.products.create');
    }


    public function store(Request $request)
    {
        dd(__METHOD__, $request->all());
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        dd(__METHOD__, $product, $request->all());

    }

    public function destroy(Product $product)
    {
        if ($product->delete()) return view('admin.products.index')->with('status', 'Delete successfully');
    }

}
