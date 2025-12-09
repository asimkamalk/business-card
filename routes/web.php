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
    return view('welcome', compact('products'));
})->name('home');

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
});

// Catch-all route for public profiles (must be last)
Route::get('/{username}', [PublicProfileController::class, 'show'])
    ->name('public.profile');
