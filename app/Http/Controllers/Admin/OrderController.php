<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan semua pesanan (termasuk yang selesai)
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.food'])
            ->latest()
            ->get();

        // Jika hanya ingin menampilkan pesanan yang belum selesai, gunakan ini:
        // ->where('status', '!=', 'selesai')

        $total = $orders->sum('total_price');

        return view('admin.orders.index', compact('orders', 'total'));
    }

    // Mengubah status pesanan
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai'
        ]);

        // Tidak bisa ubah status jika sudah selesai
        if ($order->status === 'selesai') {
            return back()->with('error', 'Status pesanan tidak bisa diubah karena sudah selesai.');
        }

        // Cegah perubahan status ke status sebelumnya (status hanya boleh naik)
        $statusUrutan = ['pending' => 1, 'proses' => 2, 'selesai' => 3];

        if ($statusUrutan[$request->status] < $statusUrutan[$order->status]) {
            return back()->with('error', 'Status tidak boleh diturunkan.');
        }

        $order->update(['status' => $request->status]);

        \Log::info('Status pesanan #' . $order->id . ' diubah menjadi: ' . $request->status);

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    // Menghapus pesanan
    public function destroy(Order $order)
    {
        $order->delete(); // order_items otomatis ikut terhapus jika FK cascade aktif
        return redirect()->back()->with('success', 'Data pesanan berhasil dihapus.');
    }
}
