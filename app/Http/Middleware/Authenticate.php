<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            if ($request->routeIs('admin.*')) {
                return route('admin.show.login');
            }

            if ($request->routeIs('client.*')) {
                return route('client.login');
            }

            if ($request->routeIs('user.*')) {
                return route('user.login');
            }

            return route('front.home');
        }
    }
}
