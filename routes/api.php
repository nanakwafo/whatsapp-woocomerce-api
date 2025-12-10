<?php
use App\Http\Controllers\Api\LicenseAdminController;
use App\Http\Controllers\Api\LicenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
Route::post('/check-license', [LicenseController::class, 'check']);

//Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
Route::prefix('admin')->group(function () {
    Route::get('/licenses', [LicenseAdminController::class, 'index']);
    Route::post('/licenses', [LicenseAdminController::class, 'store']);
    Route::get('/licenses/{license}', [LicenseAdminController::class, 'show']);
    Route::put('/licenses/{license}', [LicenseAdminController::class, 'update']);
    Route::post('/licenses/{license}/regenerate', [LicenseAdminController::class, 'regenerate']);
    Route::post('/licenses/{license}/revoke', [LicenseAdminController::class, 'revoke']);
    Route::post('/licenses/{license}/restore', [LicenseAdminController::class, 'restore']);
});
