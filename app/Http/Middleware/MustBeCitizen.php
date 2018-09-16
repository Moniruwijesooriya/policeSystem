<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class MustBeCitizen
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
        if(!$request->user()){return redirect('/');} //if not loged in system redirects to the home page

        if($request->user()->isCitizen()){
            return $next($request);
        }
        return redirect(('/'));
    }
}
