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
        // if (!Auth::guard('student')->guest()) {
        //     abort(403, 'Unauthorized action.');
        // }
        return $request->expectsJson() ? null : route('subdomain.login');
    }
}
