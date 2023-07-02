<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth as Auth;
class CekUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level)
    {
        $user = Auth::user();
        if($user && $user->level != $level){
            return redirect('/');
        }
        else return $next($request);
    }
}
