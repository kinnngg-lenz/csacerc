<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role=1)
    {
        /**
         * Account Role
         * ------------
         * 0 -> Member
         * 1 -> Moderator
         * 2 -> Admin
         * 3 -> Super Admin
         * 4 -> Lead Developer
         */

        /**
         * If Tampered role ie not in 0-4
         */
        if($request->user()->role > 4)
        {
            return redirect('/')->withNotification("Sorry buddy! You are not authorized for that action.");
        }

        /**
         * Check for rights and with params if provided.
         */
        if($request->user()->role < $role)
        {
            return redirect('/')->withNotification("Sorry buddy! You are not authorized for that action.");
        }

        return $next($request);
    }
}
