<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Service\ProductImageService;


class ProductController extends BaseController
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
        $product = Product::create($data);

        if (!empty($data['images'])) {
            ProductImageService::addImagesToProduct($product, $data['images']);
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
        $data = $request->validated();

        if ($product->update($data)) ;
        if (!empty($data['images'])) {
            ProductImageService::addImagesToProduct($product, $data['images']);
        }

        return redirect()->route('admin.products.index')->with('status', 'Product update successfully');
    }

    public function destroy(Product $product)
    {
        $orders = $product->orders;
        $product->delete();
        Order::recalc($orders);

        return redirect()->route('admin.products.index')->with('status', 'Delete successfully');
    }

}
