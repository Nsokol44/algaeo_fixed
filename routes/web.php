<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/resources', function () {
    return view('resources');
})->name('resources');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe.store');

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
