<?php

namespace App\Http\Middleware;

use Closure;
use Igniter\User\Facades\AdminAuth;
use Igniter\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AutoLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Only run if we are in the admin area and not logged in
        if (str_starts_with($request->path(), config('igniter-system.adminUri', 'admin')) && !AdminAuth::check()) {
            $user = User::where('is_activated', true)->first();
            
            if ($user) {
                AdminAuth::login($user);
                Log::debug('Auto-logged in admin user: ' . $user->email);
            }
        }

        return $next($request);
    }
}
