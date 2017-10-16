<?php

namespace UGCore\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$roles)
    {
        $arrayRoles=explode("|",$roles);
        if(auth()->user()->evaluateRoles($arrayRoles)>0){
            return $next($request);
        }else{
            if ($request->ajax()) {
                return response()->json(['Acceso no autorizado para realizar esta operaci&oacute;n'],401);
            } else {
                abort(401,'Acceso No Autorizado!!');
            }
        }
    }
}
