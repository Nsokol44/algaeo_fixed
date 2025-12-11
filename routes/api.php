<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecommendationController;

// health check for testing
Route::get('/health', function () {
    return ['status' => 'ok'];
});

// main recommendation endpoint
Route::get('/recommend', [RecommendationController::class, 'index']);
