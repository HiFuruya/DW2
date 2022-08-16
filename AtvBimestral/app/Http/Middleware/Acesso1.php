<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Acesso1
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
        $nivel = 2;
        $url = trim($request->getRequestUri());
        if ($nivel == 1) {
            if ($url != trim('/cursos') && $url != trim('/eixos') && $url != trim('/'))
                return response()->view('components.acessoNegado');
        }elseif ($nivel == 2) {
            $arr = explode('/', $url);
            $teste = trim($arr[1]);
            if ($teste == trim("professores") || $teste == trim("alunos") || $teste == trim("disciplinas") || $teste == trim("vinculos")) {
                if ($url != trim("/professores") && $url != trim("/alunos") && $url != trim("/disciplinas") && $url != trim("/vinculos")) 
                    return response()->view('components.acessoNegado');
            }
        }
        return $next($request);
        
    }
}
