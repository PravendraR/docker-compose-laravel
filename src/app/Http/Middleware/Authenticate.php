<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // this force responses in json format only 
        
        $request->headers->set('Accept', 'application/json');
        return $request->expectsJson() ? null : route('login');
    }
}
