<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPasscode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the passcode has been set in the session
        if (!$request->session()->has('passcode_verified')) {
            // Redirect to the passcode form if it's not set
            $request->session()->put('url.intended', $request->url());
            return redirect()->route('passcode.form');
        }

        return $next($request);
    }
}
