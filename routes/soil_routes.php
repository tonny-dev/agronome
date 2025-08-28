<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoilTestController;
use App\Http\Controllers\Api\SoilTestApiController;

// Web Routes for Soil Testing
Route::middleware(['auth'])->group(function () {
    Route::get('/soil-dashboard', [SoilTestController::class, 'dashboard'])->name('soil.dashboard');
    Route::get('/soil-samples', [SoilTestController::class, 'index'])->name('soil.index');
    Route::get('/soil-samples/create', [SoilTestController::class, 'create'])->name('soil.create');
    Route::post('/soil-samples', [SoilTestController::class, 'store'])->name('soil.store');
    Route::get('/soil-samples/{sample}', [SoilTestController::class, 'show'])->name('soil.show');
    Route::post('/soil-samples/{sample}/results', [SoilTestController::class, 'addResults'])->name('soil.add-results');
});

// API Routes for Soil Testing
Route::prefix('api')->middleware(['auth'])->group(function () {
    Route::get('/chemical-test-parameters', [SoilTestApiController::class, 'getParameters']);
    Route::get('/soil-samples/{sample}/recommendations', [SoilTestApiController::class, 'getRecommendations']);
    Route::post('/soil-samples/{sample}/generate-report', [SoilTestApiController::class, 'generateReport']);
});
