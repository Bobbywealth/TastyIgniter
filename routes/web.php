<?php

use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// #region agent log
file_put_contents('/Users/bobbyc/tasty igniter/TastyIgniter/.cursor/debug.log', json_encode(['id' => 'log_web_routes_load', 'timestamp' => microtime(true)*1000, 'location' => 'routes/web.php:12', 'message' => 'Web routes loading', 'data' => [], 'sessionId' => 'debug-session', 'hypothesisId' => 'A']) . PHP_EOL, FILE_APPEND);
// #endregion

// Move Marketing to its own sub-page
Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
Route::post('/subscribe', [MarketingController::class, 'subscribe'])->name('marketing.subscribe');

// Leave the root "/" empty so TastyIgniter's restaurant theme can load automatically
