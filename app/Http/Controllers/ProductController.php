<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Anda tidak mempunyai Akses! ');
        }

        $categories = \App\Models\ProductCategory::all();
        return view('products.create', [
            'product' => new Product(),
            'categories' => $categories,
            'action' => route('products.store'),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $data = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'product_description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        if ($request->hasFile('product_photo')) {
            $data['product_photo'] = $request->file('product_photo')->store('products', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $categories = \App\Models\ProductCategory::all();
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'action' => route('products.update', $product),
            'isEdit' => true
        ]);
    }

    public function update(Request $request, Product $product)
    {

        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }
        $data = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'product_description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        if ($request->hasFile('product_photo')) {
            $data['product_photo'] = $request->file('product_photo')->store('products', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }

    public function getProducts()
    {
        $products = Product::all();

        foreach ($products as $product) {
            if ($product->product_photo) {
                $product->product_photo = asset('storage/' . $product->product_photo);
            }
        }

        return response()->json($products);
    }


}
