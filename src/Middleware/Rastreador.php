<?php

namespace App\Http\Middleware\codviews;
use Codwelt\codviews\Clases\Visitas;
use Closure;

class Rastreador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $visitas = new Visitas();
        $visitas->visita(url($request->getPathInfo()));
        return $next($request);
    }
}
