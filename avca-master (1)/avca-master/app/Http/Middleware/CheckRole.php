<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
            switch ($request->user()->tipo) {
                case 'Operador de Trafico': //si es un operador
                    return redirect('taquilla');
                    break;
                
                case 'Subgerente de Sucursal': //si es un Administrador de Sucursal
                    return redirect('sucursal');
                    break;
                
                case 'Gerente de Sucursales': //si es el Gerente de Sucursales
                    return redirect('gerente-sucursales');
                    break;
                
                case 'Gerente General': //si es un Gerente General
                    return redirect('gerencia-general');
                    break;
                
                default:
                    //redirecciona a un error usuario no identificado
                    //me falta desautenticación
                    return redirect('/');
                    break;
            }
        }
        return $next($request);
    }
}
