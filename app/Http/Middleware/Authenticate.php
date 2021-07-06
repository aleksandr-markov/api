<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponser;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    use ApiResponser;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
//        if (auth()->user()->tokenCan()-) {
//
//        }
        if (!$request->expectsJson()) {
            abort('403', 'forbidden');
//            return route('login');
        }
    }
}
