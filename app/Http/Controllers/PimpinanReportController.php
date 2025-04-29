<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PimpinanReportController extends Controller
{
    public function harian()
    {
        $start = Carbon::today()->startOfDay();
        $end = Carbon::today()->endOfDay();

        $data = $this->getReportData($start, $end);

        return view('pimpinan.reports.harian', compact('data'));
    }

    public function mingguan()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $data = $this->getReportData($startOfWeek, $endOfWeek);

        return view('pimpinan.reports.mingguan', compact('data'));
    }

    public function bulanan()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $data = $this->getReportData($startOfMonth, $endOfMonth);

        return view('pimpinan.reports.bulanan', compact('data'));
    }

    private function getReportData($startDate, $endDate)
    {
        return OrderDetail::select(
            'products.product_name',
            DB::raw('SUM(order_details.qty) as total_qty'),
            DB::raw('SUM(order_details.qty * products.product_price) as total_sales')
        )
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->groupBy('products.product_name')
            ->orderByDesc('total_sales')
            ->get();
    }

    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = null;

        if ($startDate && $endDate) {
            $data = $this->getReportData(Carbon::parse($startDate), Carbon::parse($endDate));
        }

        return view('pimpinan.reports.filter', compact('data', 'startDate', 'endDate'));
    }
}
