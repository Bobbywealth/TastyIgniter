<?php

use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Move the Marketing Page to /marketing
Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
Route::post('/subscribe', [MarketingController::class, 'subscribe'])->name('marketing.subscribe');

// Redirect the home page to the Admin for now so you can set up the restaurant
Route::get('/', function () {
    return redirect('/admin');
});
