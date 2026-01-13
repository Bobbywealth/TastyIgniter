<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // #region agent log
                file_put_contents('/Users/bobbyc/tasty igniter/TastyIgniter/.cursor/debug.log', json_encode(['id' => 'log_redirect_auth', 'timestamp' => microtime(true)*1000, 'location' => 'app/Http/Middleware/RedirectIfAuthenticated.php:27', 'message' => 'Redirecting authenticated user', 'data' => ['guard' => $guard, 'destination' => RouteServiceProvider::HOME], 'sessionId' => 'debug-session', 'hypothesisId' => 'C']) . PHP_EOL, FILE_APPEND);
                // #endregion
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
