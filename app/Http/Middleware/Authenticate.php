<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!Auth::guard('student')->guest()) {
            return route('student.dashboard.index');
        }
        if (!Auth::guard('parent')->guest()) {
            return route('parent.dashboard.index');
        }
        return $request->expectsJson() ? null : route('subdomain.login');
    }
}
