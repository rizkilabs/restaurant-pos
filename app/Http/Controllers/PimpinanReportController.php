<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use Carbon\Carbon;
use App\Models\Order;
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
        return OrderDetail::with(['product', 'order'])
            ->whereHas('order', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->orderByDesc(
                Order::select('created_at')
                    ->whereColumn('orders.id', 'order_details.order_id')
                    ->limit(1)
            )
            ->paginate(10);
    }




    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = null;

        if ($startDate && $endDate) {
            $data = $this->getReportData(Carbon::parse($startDate), Carbon::parse($endDate)->endOfDay());
        }

        return view('pimpinan.reports.filter', compact('data', 'startDate', 'endDate'));
    }
}
