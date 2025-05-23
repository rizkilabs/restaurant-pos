<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Models\Product;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->get();
        $products = Product::all();
        return view('orders.index', compact('orders', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
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
            'order_amount' => 'required|numeric|min:0',
            'order_change' => 'required|numeric|min:0',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1',
        ]);


        $order = Order::create([
            'order_code' => $request->order_code,
            'order_status' => $request->order_status,
            'order_amount' => $request->order_amount,
            'order_change' => $request->order_change,
        ]);


        foreach ($request->products as $product) {
            $productData = Product::find($product['product_id']);
            $subtotal = $product['qty'] * $productData->product_price;

            $order->details()->create([
                'product_id' => $product['product_id'],
                'qty' => $product['qty'],
                'order_price' => $productData->product_price,
                'order_subtotal' => $subtotal,
            ]);


            $productData->decrement('stock', $product['qty']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil disimpan.'
        ]);
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
