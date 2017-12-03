<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleOperador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()){
            if($request->user()->tipo=='Operador') {
                return $next($request);
            }
            else{
                return redirect('/home');
            }
        }
        return redirect('/home');
    }
}
