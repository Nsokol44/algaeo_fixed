<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

// Public marketing pages
//
Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

//
// Blog (News & Articles)
//
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');

//
// Shop
//
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/account', function () {
    return view('pages.shop.account');
})->name('shop.account');

Route::get('/shop/checkout', function () {
    return view('pages.shop.checkout');
})->name('shop.checkout');

Route::get('/shop/cart', function () {
    return view('pages.shop.cart');
})->name('shop.cart');


//
// Internal Tools (optional)
//
Route::view('/tools', 'tools.index')->name('tools.index');



// Laravel Breeze Authentication Routes
require __DIR__.'/auth.php';

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard route (shows user's fields or dashboard content)
    Route::get('/dashboard', [FieldController::class, 'index'])->name('dashboard');

    // Profile management routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Field Management Routes (full CRUD)
    Route::resource('fields', FieldController::class);
});

// Blog routes (accessible publicly)
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');
