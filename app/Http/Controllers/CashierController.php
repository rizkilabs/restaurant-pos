<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\OrderDetail;

class CashierController extends Controller
{
    public function create()
    {
        $products = Product::where('is_active', true)->get();
        return view('cashier.create', compact('products'));
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'order_code' => 'ORD-' . time(),
            'order_detail' => $request->order_detail,
            'order_amount' => $request->order_amount,
            'order_status' => 'paid',
            'order_change' => 0
        ]);

        $details = json_decode($request->order_detail, true);

        foreach ($details as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'order_price' => $item['price'],
                'qty' => $item['qty'],
                'order_subtotal' => $item['subtotal'],
            ]);
        }

        return redirect()->route('cashier.index')->with('success', 'Transaksi berhasil disimpan!');
    }
}
