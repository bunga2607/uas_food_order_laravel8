<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\FoodController as AdminFoodController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

use App\Http\Controllers\User\FoodOrderController;
use App\Http\Controllers\User\RatingUserController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

// Halaman awal
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Laravel UI
Auth::routes();

// Redirect setelah login sesuai role
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ================= ADMIN ===================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD makanan
    Route::resource('foods', AdminFoodController::class);

    // Pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // Laporan
    Route::get('/laporan', [ReportController::class, 'index'])->name('report.index');
    Route::get('/laporan/pdf', [ReportController::class, 'exportPdf'])->name('report.pdf');

    // Rating
    Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');

    // Kontak
    Route::get('/kontak', [ContactController::class, 'edit'])->name('kontak.edit');
    Route::post('/kontak', [ContactController::class, 'update'])->name('kontak.update');

    // Edit Profil Admin
    Route::get('/profil', [AdminProfileController::class, 'edit'])->name('profil.edit');
    Route::post('/profil', [AdminProfileController::class, 'update'])->name('profil.update');
});

// ================= USER ===================
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/foods', [FoodOrderController::class, 'index'])->name('foods.index');
    Route::get('/order/create', [FoodOrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [FoodOrderController::class, 'store'])->name('order.store');
    Route::get('/orders/history', [FoodOrderController::class, 'history'])->name('orders.history');
    Route::get('/orders/{order}/print', [FoodOrderController::class, 'print'])->name('orders.print');
    Route::delete('/orders/{order}/cancel', [FoodOrderController::class, 'cancel'])->name('orders.cancel');

    // Rating
    Route::get('/orders/{order}/rating', [RatingUserController::class, 'create'])->name('ratings.create');
    Route::post('/orders/{order}/rating', [RatingUserController::class, 'store'])->name('ratings.store');

    // Kontak
    Route::get('/kontak', [ContactController::class, 'showUser'])->name('kontak');

    // Edit Profil User
    Route::get('/profil', [UserProfileController::class, 'edit'])->name('profil.edit');
    Route::post('/profil', [UserProfileController::class, 'update'])->name('profil.update');
});
