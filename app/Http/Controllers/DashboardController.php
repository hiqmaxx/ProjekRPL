<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $foodCount = Food::count();
        $userCount = User::where('role', 'customer')->count();
        $orderCount = Order::count();

        $recentFoods = Food::latest()->take(5)->get();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'foodCount',
            'userCount',
            'orderCount',
            'recentFoods',
            'recentOrders'
        ));
    }
}
