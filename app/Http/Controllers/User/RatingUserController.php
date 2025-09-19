<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingUserController extends Controller
{
    public function create(Order $order)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'selesai') {
            abort(403);
        }

        return view('user.ratings.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'selesai') {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        if (Rating::where('order_id', $order->id)->exists()) {
            return redirect()->route('user.orders.history')->with('error', 'Kamu sudah memberi ulasan sebelumnya.');
        }

        Rating::create([
            'user_id' => Auth::id(),
            'order_id' => $order->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('user.orders.history')->with('success', 'Terima kasih atas ulasannya!');
    }
}
