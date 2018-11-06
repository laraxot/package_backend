<?php

namespace XRA\Backend\Middleware;

use Closure;
//--- Models ---
use XRA\LU\Models\PermUser;

class CheckPermUser
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
        $perm_user = PermUser::where('auth_user_id', \Auth::user()->auth_user_id)->first();
        \Session::put('perm_user', $perm_user->perm_type);

        if ($perm_user->perm_type >= 4) {
            return $next($request);
        } else {
            return redirect()->intended('/admin/ew8');
        }
    }
}
