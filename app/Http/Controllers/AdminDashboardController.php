<?php

namespace App\Http\Controllers;


use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function adminDashboard()
{
    $topProducts = OrderDetail::select('product_id', DB::raw('SUM(qty) as total_sold'))
        ->groupBy('product_id')
        ->orderByDesc('total_sold')
        ->with('product')
        ->take(5)
        ->get();

    return view('admin.dashboard', compact('topProducts'));
}
}
