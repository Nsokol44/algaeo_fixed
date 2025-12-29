<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecommendationController;

// health check for testing
Route::get('/health', function () {
    return ['status' => 'ok'];
});

// v1 recommendation endpoint (POST + versioned path)
Route::post('/v1/recommendations', [RecommendationController::class, 'index']);
