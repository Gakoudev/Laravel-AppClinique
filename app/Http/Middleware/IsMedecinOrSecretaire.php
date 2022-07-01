<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsMedecinOrSecretaire
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
        if($request->user()->hasRole('MEDECIN') || $request->user()->hasRole('SECRETAIRE'))
        {
            return $next($request);
        }
        else{

            return redirect('dashboard');
        }
    }
    
}
