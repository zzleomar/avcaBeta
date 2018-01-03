<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleAsistenteRRHH
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
            if(($request->user()->tipo=='Asistente de RRHH')||($request->user()->tipo=='Subgerente de Sucursal')) {                
                return $next($request);
            }
            else{
                return redirect('/');
            }
        }
        return redirect('/');
    }
}
