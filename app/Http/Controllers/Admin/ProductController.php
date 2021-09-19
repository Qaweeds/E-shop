<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::query()->paginate(12);

        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all(['id', 'name']);
        return view('admin.products.create', compact('categories'));
    }


    public function store(ProductCreateRequest $request)
    {
        $data = $request->validated();
        $product = Product::query()->create($data);

        if (!empty($data['images'])) {
            foreach ($data['images'] as $image) {
                ProductImage::query()->create(['product_id' => $product->id, 'path' => $image]);
            }
        }

        return redirect()->route('admin.products.index')->with('status', 'Product create successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all(['id', 'name']);
        return view('admin.products.edit', compact('product', 'categories'));
    }


    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->all();

        if ($product->update($data)) return redirect()->route('admin.products.index')->with('status', 'Product update successfully');
    }

    public function destroy(Product $product)
    {


        if ($product->delete()) return redirect()->route('admin.products.index')->with('status', 'Delete successfully');
    }

}
