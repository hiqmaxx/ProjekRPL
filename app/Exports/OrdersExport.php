<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Order::with('user', 'items.food')->get()->map(function ($order) {
            $makanan = $order->items->map(function ($item) {
                return $item->food->name . ' x ' . $item->quantity;
            })->implode(', ');

            return [
                'customer' => $order->user->name,
                'makanan' => $makanan,
                'total' => $order->total_price,
                'status' => $order->status,
                'qris_type' => $order->qris_type ?? '-', // jika kamu simpan jenis qris
                'created_at' => $order->created_at->format('Y-m-d H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Customer',
            'Makanan',
            'Total',
            'Status',
            'QRIS Type',
            'Tanggal',
        ];
    }
}

