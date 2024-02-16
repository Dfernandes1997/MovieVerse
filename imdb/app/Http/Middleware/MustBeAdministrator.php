<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeAdministrator
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
        if (auth()->guest()){
            abort(Response::HTTP_FORBIDDEN); //se for guest sem conta não entra no admin
        }

        if(auth()->user()->is_admin != '1') { // apenas entra no admin view se a coluna is_admin do user for true
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
