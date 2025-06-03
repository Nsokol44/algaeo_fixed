<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriberController; // Ensure FieldController is imported
use Illuminate\Support\Facades\Auth; // Auth::routes() requires this

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

// Public landing page (home.blade.php)
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/resources', function () {
    return view('resources');
})->name('resources');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Newsletter
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe.store');

//Contact us routes
// Contact Us Routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact'); // For displaying the form
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit'); // For handling the form submission

// Authentication routes provided by Laravel Breeze (login, register, logout, etc.)
Auth::routes(); // This should be before your custom authenticated routes for simplicity
//require __DIR__.'/auth.php'; // This file contains specific Breeze auth routes (e.g., password reset)

// Authenticated user routes (requires user to be logged in)
Route::middleware(['auth'])->group(function () {
    // Dashboard route: Now handled by FieldController to pass the $fields variable
    // This replaces your old /dashboard route that returned just a view.
    Route::get('/dashboard', [FieldController::class, 'index'])->name('dashboard');

    // Profile management routes (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Field management routes
    // Note: The `Route::resource('fields', FieldController::class)->except(['edit', 'update', 'destroy']);`
    // will create 'fields.store' and 'fields.show' as you had.
    // I'm explicitly defining 'fields.create' and 'fields.store' for clarity
    // as you specifically used them in your views.
    Route::get('/fields/create', [FieldController::class, 'create'])->name('fields.create');
    Route::post('/fields', [FieldController::class, 'store'])->name('fields.store');
    Route::get('/fields/{field}', [FieldController::class, 'show'])->name('fields.show');
});


// For showing posts
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
// The {post:slug} tells Laravel to look up the post by its 'slug' column
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');