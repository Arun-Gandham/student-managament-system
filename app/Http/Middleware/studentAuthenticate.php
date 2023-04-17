<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class studentAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('student')->guest()) return redirect()->route('student.login');
        if(!auth()->guard('student')->guest() && auth()->guard('student')->user()->role != env('STUDENT_ROLE_ID')) abort('403',"Unauthorized Action");
        return $next($request);
    }
}
