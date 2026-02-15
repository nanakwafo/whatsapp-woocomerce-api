<?php
use App\Http\Controllers\Api\LicenseAdminController;
use App\Http\Controllers\Api\LicenseController;

use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\Api\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::middleware(['waorders.signature'])->group(function () {

   Route::post('/check-license', [LicenseController::class, 'check']);

   //send message  where session is handled in plugin
   Route::post('/message/send', [MessageController::class, 'sendMessage']);
   Route::post('/message/send-template', [MessageController::class, 'sendMessageTemplateWithText']);

   //send message where session is handle by backend
   Route::post('/message/sendwhatsapp', [MessageController::class, 'send']);
   //webhook for receiving messages from whatsapp configured on facebook developer portal
//    Route::post('/webhook/whatsapp', [MessageController::class, 'webhook']);
   Route::match(['get', 'post'], '/webhook/whatsapp', [MessageController::class, 'webhook']);
}); 



Route::post('/license/deactivate', [LicenseController::class, 'deactivate']);
Route::post('/leads', [LeadController::class, 'store']);

Route::post('/payment/initialize', [PaymentController::class, 'initialize'])->name('payment.initialize');
Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');


Route::post('/webhook/paystack', [WebhookController::class, 'handle']);

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
