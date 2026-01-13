<?php

use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// The Marketing Page is the main entry point
Route::get('/', [MarketingController::class, 'index'])->name('marketing.index');
Route::post('/subscribe', [MarketingController::class, 'subscribe'])->name('marketing.subscribe');

// The TastyIgniter Admin is still at /admin
// The TastyIgniter Storefront (if needed) will be handled by TI core routes
