<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }
     public function checkout()
    {
        $foods = Food::all();
        return view('customer.checkout', compact('foods'));
    }


    public function placeOrder(Request $request)
    {
         $data = $request->validate([
            'food_ids'   => 'required|array',
            'quantities' => 'required|array',
            'qris_type'  => 'required|string',
            'qris_image' => 'required|image|max:2048'
        ]);

        $order = Order::create([
            'user_id'     => Auth::id(),
            'status'      => 'pending',
            'qris_type'   => $data['qris_type'],
            'qris_image'  => $request->file('qris_image')->store('qris', 'public'),
            'total_price' => 0
        ]);

        $total = 0;

        foreach ($data['food_ids'] as $index => $foodId) {
            $qty = $data['quantities'][$index];
            $food = Food::findOrFail($foodId);
            $total += $food->price * $qty;

            OrderItem::create([
                'order_id' => $order->id,
                'food_id'  => $foodId,
                'quantity' => $qty,
            ]);
        }

        $order->update(['total_price' => $total]);

        return redirect()->route('orders.my')->with('success', 'Pesanan berhasil dibuat!');
    }

    // CUSTOMER - Lihat pesanan sendiri
    public function myOrders()
    {
        $orders = Auth::user()->orders()->with('items.food')->get();
        return view('customer.orders', compact('orders'));
    }

    // ADMIN - Lihat semua pesanan
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.food'])->orderBy('created_at', 'desc');

    if ($request->has('type') && in_array($request->type, ['laksa', 'asinan'])) {
        $query->whereHas('items.food', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->type . '%');
        });
    }

    $orders = $query->get();
    return view('admin.orders.index', compact('orders'));
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'approved']);
        return back()->with('success', 'Pesanan disetujui!');
    }

    public function decline($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'pending') {
            $order->update(['status' => 'declined']);
            return back()->with('success', 'Pesanan berhasil ditolak.');
        }

        return back()->with('error', 'Pesanan tidak dapat ditolak.');
    }

        public function show($id)
    {
        $order = \App\Models\Order::with(['user', 'items.food'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }


}
