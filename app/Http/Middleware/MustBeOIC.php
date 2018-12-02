<?php

namespace App\Http\Middleware;

use Closure;

class MustBeOIC
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

        if($request->user()->isOIC()){
            return $next($request);
        }
        return back();
    }
}
