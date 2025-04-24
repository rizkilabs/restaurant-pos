<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = \App\Models\Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_code' => 'required|unique:orders',
            'order_status' => 'required',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1',
        ]);

        // Simpan order
        $order = \App\Models\Order::create([
            'order_code' => $request->order_code,
            'order_status' => $request->order_status,
            'order_detail' => $request->order_detail,
            'order_amount' => 0, // Akan di-update nanti
            'order_change' => 0,
        ]);

        $total = 0;

        foreach ($request->products as $productItem) {
            $product = \App\Models\Product::find($productItem['product_id']);
            $qty = $productItem['qty'];
            $price = $product->product_price;
            $subtotal = $price * $qty;

            $order->details()->create([
                'product_id' => $product->id,
                'order_price' => $price,
                'qty' => $qty,
                'order_subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $order->update(['order_amount' => $total]);

        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_code' => 'required|unique:orders,order_code,' . $order->id,
            'order_detail' => 'nullable|string',
            'order_amount' => 'required|numeric|min:0',
            'order_status' => 'required|string',
            'order_change' => 'nullable|numeric|min:0',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
}
