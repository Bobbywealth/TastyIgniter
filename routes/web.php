<?php

use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/**
 * Your SMS Marketing Page
 * Access this at: your-site.com/marketing
 */
Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
Route::post('/subscribe', [MarketingController::class, 'subscribe'])->name('marketing.subscribe');

/**
 * THE HOME PAGE (/)
 * 
 * We are leaving the root "/" route empty here. 
 * This allows TastyIgniter's core engine to take over and load 
 * your restaurant theme (e.g., the Orange theme) automatically.
 */
