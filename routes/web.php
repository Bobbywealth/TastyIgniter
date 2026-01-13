<?php

use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Build-safe console logger
if (!function_exists('agent_log')) {
    function agent_log($message, $data = [], $hypothesisId = 'unknown') {
        @error_log("AGENT_DEBUG: " . json_encode([
            'id' => 'log_' . uniqid(),
            'timestamp' => microtime(true) * 1000,
            'location' => 'routes/web.php',
            'message' => $message,
            'data' => $data,
            'sessionId' => 'debug-session',
            'hypothesisId' => $hypothesisId
        ]));
    }
}

agent_log('Web routes loading', ['uri' => $_SERVER['REQUEST_URI'] ?? '/'], 'A');

// Debug route to see TastyIgniter configuration
Route::get('/debug-config', function() {
    return response()->json([
        'igniter-routes' => config('igniter-routes'),
        'igniter-system' => config('igniter-system'),
        'app_url' => config('app.url'),
    ]);
});

// Move Marketing to its own sub-page
Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
Route::post('/subscribe', [MarketingController::class, 'subscribe'])->name('marketing.subscribe');

// Leave the root "/" empty for TastyIgniter
