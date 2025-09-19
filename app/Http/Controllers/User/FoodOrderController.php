<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FoodOrderController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return view('user.foods.index', compact('foods'));
    }

    public function create()
    {
        $foods = Food::all();
        return view('user.orders.create', compact('foods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|min:5',
            'phone' => 'required|string|min:10',
            'payment_method' => 'required|in:cod,transfer',
            'foods.*.id' => 'required|exists:foods,id',
            'foods.*.qty' => 'required|integer|min:0',
        ]);

        $total = 0;
        $validItems = [];

        foreach ($request->foods as $item) {
            if ($item['qty'] > 0) {
                $food = Food::find($item['id']);
                $subtotal = $food->price * $item['qty'];
                $total += $subtotal;

                $validItems[] = [
                    'food_id' => $food->id,
                    'quantity' => $item['qty'],
                    'subtotal' => $subtotal,
                ];
            }
        }

        if (count($validItems) === 0) {
            return back()->with('error', 'Silakan pilih minimal 1 makanan.')->withInput();
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_date' => Carbon::now(),
            'total_price' => $total,
            'status' => 'pending',
            'address' => $request->address,
            'phone' => $request->phone,
            'note' => $request->note,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($validItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $item['food_id'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        return redirect()->route('user.orders.history')->with('success', 'Pesanan berhasil dikirim.');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
                    ->with('orderItems.food')
                    ->latest()
                    ->get();

        return view('user.orders.history', compact('orders'));
    }

    public function print(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $contact = Contact::first();
        return view('user.orders.print', compact('order', 'contact'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($order->status, ['pending', 'selesai'])) {
            return back()->with('error', 'Pesanan hanya bisa dihapus jika masih pending atau sudah selesai.');
        }

        $order->delete();
        return back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
