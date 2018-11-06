<?php

namespace XRA\Backend\Middleware;

use Closure;

class CheckInstall
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
        //dd('ciao');
        if (env('INSTALLED')) {
            return $next($request);
        } else {
            return redirect('install/step1');
        }
    }
}
