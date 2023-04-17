<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class parentAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (auth()->guard('parent')->guest()) return redirect()->route('parent.login');
        $user = Auth::guard('parent')->user();

        if (!$user || !$user->checkRole($roles)) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
