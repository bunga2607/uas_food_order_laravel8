<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // Menampilkan laporan hanya pesanan yang selesai
    public function index()
    {
        $orders = Order::with('user', 'orderItems.food')
                    ->where('status', 'selesai')
                    ->latest()
                    ->get();

        $total = $orders->sum('total_price');

        return view('admin.report.index', compact('orders', 'total'));
    }

    // Export PDF hanya pesanan yang selesai
    public function exportPdf()
    {
        $orders = Order::with('user', 'orderItems.food')
                    ->where('status', 'selesai')
                    ->latest()
                    ->get();

        $pdf = Pdf::loadView('admin.report.pdf', compact('orders'));
        return $pdf->download('laporan-penjualan.pdf');
    }
}
