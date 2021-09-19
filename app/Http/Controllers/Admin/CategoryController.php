<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;


class CategoryController extends BaseController
{

    public function index()
    {
        $categories = Category::query()->withCount('products')->get();

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(CategoryCreateRequest $request)
    {
        if (Category::query()->create($request->validated())) return redirect()->route('admin.categories.index')
            ->with('status', 'Категория успешно создана');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    public function update(CategoryUpdateRequest $request, Category $category)
    {
        if ($category->update($request->validated())) return redirect()->route('admin.categories.index')
            ->with('status', 'Категория успешно создана');

    }

}
