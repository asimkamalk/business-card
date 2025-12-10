<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductController;

// Public routes
Route::get('/', function () {
    $products = \App\Models\Product::with('profile.user')
        ->where('featured', true)
        ->latest()
        ->take(6)
        ->get();
    $adminProducts = \App\Models\AdminProduct::where('is_active', true)
        ->orderBy('featured', 'desc')
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get();
    return view('welcome', compact('products', 'adminProducts'));
})->name('home');

// Public products page
Route::get('/all-products', [\App\Http\Controllers\PublicProductController::class, 'index'])->name('products.all');

// Public order routes
Route::get('/products/{productId}/order', [\App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
Route::post('/products/{productId}/order', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{id}/success', [\App\Http\Controllers\OrderController::class, 'success'])->name('orders.success');

// Authentication routes (must come before catch-all route)
require __DIR__ . '/auth.php';

// User dashboard routes (must come before catch-all route)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['put', 'patch'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Product routes
    Route::resource('products', ProductController::class);
});

// Admin routes (must come before catch-all route)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // User management
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
    Route::post('users/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk-action');
    Route::post('users/{user}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
    Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.force-delete');
    
    // Admin Products (NFC Cards) management
    Route::resource('admin-products', \App\Http\Controllers\Admin\AdminProductController::class);
    
    // Orders management
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{id}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::delete('orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');
});

// Public product view route (must be before catch-all)
Route::get('/{username}/product/{productId}', [PublicProfileController::class, 'showProduct'])
    ->name('public.product');

// Download vCard contact file
Route::get('/{username}/vcard', [PublicProfileController::class, 'downloadVCard'])
    ->name('public.vcard');

// Catch-all route for public profiles (must be last)
Route::get('/{username}', [PublicProfileController::class, 'show'])
    ->name('public.profile');
