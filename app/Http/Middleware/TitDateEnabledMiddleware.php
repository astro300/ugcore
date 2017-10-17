<?php

namespace UGCore\Http\Middleware;

use Closure;

class TitDateEnabledMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $parameter)
    {
// $usuario=currentUser()->id;
        // dd($usuario);
        # code...
        // abort(401);

        switch ($parameter) {

            case 'EC':


                break;
            case 'TUTORIAS':


                break;
            case 'REVISIONES':


                break;
            case 'CONF':


                break;
            case 'TRABAJOTIT':


                break;
            default:
                abort(401);
                break;
        }
        return $next($request);
    }
}
