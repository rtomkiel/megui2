<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->type !== 'admin') {
            return  \Illuminate\Support\Facades\Redirect::to('/home');
        }
        return $next($request);
    }

}