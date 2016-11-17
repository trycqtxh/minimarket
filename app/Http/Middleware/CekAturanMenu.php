<?php

namespace App\Http\Middleware;

use Closure;

class CekAturanMenu
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
        if($request->user() === null){
            return response('Permisison', 401);
        }
        $actions = $request->route()->getAction();
        $aturan = isset($actions['aturan']) ? $actions['aturan'] : null;
        if($request->user()->status->hasAnyAturanMenu($aturan) || !$aturan){
            return $next($request);
        }
        return response('Permisison', 401);
    }
}
