<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

// Auth routes (login, register, logout, etc.)
require __DIR__.'/auth.php';

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [FieldController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/fields/create', [FieldController::class, 'create'])->name('fields.create');
    Route::post('/fields', [FieldController::class, 'store'])->name('fields.store');
    Route::get('/fields/{field}', [FieldController::class, 'show'])->name('fields.show');
});

// Blog routes
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');
