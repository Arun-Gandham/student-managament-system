<?php

namespace App\Http\Middleware;

use App\Models\subdomains;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class subdomainCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subdomain = $request->segment(1);
        $subdomains = unserialize(env("SUB_DOMAINS_SERIALIZED"));
        if(!isset($subdomains[$subdomain])) abort(403,"unauthorized");

        // if(auth()->check() && ($subdomains[$subdomain] != auth()->user()->schoolData->subdomain_id)) { echo "subdomine not found from subdomine heck middleware error"; print_r(auth()->user()->schoolData); exit; };
        return $next($request);
    }
}
