<?php

use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;

// #region agent log
function agent_log($message, $data = [], $hypothesisId = 'unknown') {
    $logEntry = json_encode([
        'id' => 'log_' . uniqid(),
        'timestamp' => microtime(true) * 1000,
        'location' => 'routes/web.php',
        'message' => $message,
        'data' => $data,
        'sessionId' => 'debug-session',
        'hypothesisId' => $hypothesisId
    ]);
    // Log to Render console
    error_log("AGENT_DEBUG: " . $logEntry);
    // Log to file for /debug-logs route
    @file_put_contents(storage_path('logs/debug.log'), $logEntry . PHP_EOL, FILE_APPEND);
}
// #endregion

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

agent_log('Web routes loading', ['uri' => $_SERVER['REQUEST_URI'] ?? '/'], 'A');

// Debug route to see logs from Render
Route::get('/debug-logs', function() {
    $path = storage_path('logs/debug.log');
    $routesPath = storage_path('logs/routes_before_cache.txt');
    
    $data = [
        'logs' => [],
        'routes_file' => file_exists(base_path('routes/web.php')) ? 'exists' : 'missing',
        'is_cached' => app()->routesAreCached() ? 'yes' : 'no',
        'routes_dump' => file_exists($routesPath) ? file_get_contents($routesPath) : 'no dump found'
    ];
    
    if (file_exists($path)) {
        $logs = explode(PHP_EOL, trim(file_get_contents($path)));
        $data['logs'] = array_map('json_decode', $logs);
    }
    
    return response()->json($data);
});

// Move Marketing to its own sub-page
Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
Route::post('/subscribe', [MarketingController::class, 'subscribe'])->name('marketing.subscribe');

// Leave the root "/" empty so TastyIgniter's restaurant theme can load automatically

// Final catch-all for debugging fallthrough
Route::any('{any}', function($any) {
    agent_log('Fallback route reached', ['path' => $any], 'D');
    // If we reach here, TI hasn't handled it yet.
    return response()->json(['message' => 'Fallback reached', 'path' => $any]);
})->where('any', '.*');
