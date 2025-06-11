<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderExportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Models\Food;

Route::get('/orders/export', [OrderExportController::class, 'export'])->name('orders.export');

Route::resource('orders', OrderController::class);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/profile', fn() => view('profile'))->name('profile')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::get('/', function () {
    $foods = Food::all();
    return view('welcome', compact('foods'));
});
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard', [
        'foodCount' => \App\Models\Food::count(),
        'userCount' => \App\Models\User::where('role', 'customer')->count(),
        'orderCount' => \App\Models\Order::count(),
        'recentFoods' => \App\Models\Food::latest()->take(5)->get(),
        'recentOrders' => \App\Models\Order::latest()->take(5)->get(),
    ]);
})->name('admin.dashboard');
Route::middleware(['auth'])->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::resource('/admin/foods', FoodController::class);
        Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/admin/orders/{id}/approve', [OrderController::class, 'approve'])->name('orders.approve');
        Route::post('/admin/orders/{id}/decline', [OrderController::class, 'decline'])->name('orders.decline');
    });

    Route::middleware('role:customer')->group(function () {
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('/order', [OrderController::class, 'placeOrder'])->name('order.place');
        Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
