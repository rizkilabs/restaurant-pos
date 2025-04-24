<?php

namespace App\Http\Controllers;
use App\Models\ProductCategory;

use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::latest()->paginate(10);
        return view('product_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('product_categories.create', [
            'productCategory' => new ProductCategory(),
            'action' => route('product-categories.store'),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        ProductCategory::create($request->only('name'));

        return redirect()->route('product-categories.index')->with('success', 'Category created!');
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('product_categories.edit', [
            'productCategory' => $productCategory,
            'action' => route('product-categories.update', $productCategory),
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $productCategory->update($request->only('name'));

        return redirect()->route('product-categories.index')->with('success', 'Category updated!');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return back()->with('success', 'Category deleted.');
    }
}
