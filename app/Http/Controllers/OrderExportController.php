<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;

class OrderExportController extends Controller
{
    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.food'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}
