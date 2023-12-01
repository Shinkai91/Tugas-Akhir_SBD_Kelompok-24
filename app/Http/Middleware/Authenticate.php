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
        // If the request is not expecting JSON (i.e., a web request)
        if (! $request->expectsJson()) {
            // Redirect unauthenticated users to the login route
            return route('login');
        }
        
        // If the request is expecting JSON, return null to indicate the user is not authenticated
        return null;
    }
}