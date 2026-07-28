<?php

use App\Http\Controllers\VapiWebhookController;
use App\Http\Controllers\ServioWebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/vapi/webhook', [VapiWebhookController::class, 'handle'])
    ->name('vapi.webhook');

// Servio Voice AI Integration
Route::prefix('servio')->group(function () {
    Route::post('/order', [ServioWebhookController::class, 'order']);
    Route::get('/menu', [ServioWebhookController::class, 'menu']);
});
