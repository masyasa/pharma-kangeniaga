<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->middleware('role:owner')->group(function () {
        Route::resource('products', ProductController::class)->parameters(['products' => 'product:slug']);;
        Route::resource('categories', CategoryController::class)->parameters(['categories' => 'category:slug']);
        Route::resource('buyers', BuyerController::class)->parameters(['buyers' => 'buyer:name']);;
        Route::resource('transactions', TransactionController::class)->parameters(['transactions' => 'transaction:slug']);;
    });
    Route::prefix('buyer')->name('buyer.')->group(function () {
        Route::resource('cart', CartController::class)->middleware('role:buyer');
    });
});

use App\Livewire\Counter;

Route::get('/counter', Counter::class);

require __DIR__ . '/auth.php';
