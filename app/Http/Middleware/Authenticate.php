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
        $url = $request->server('REQUEST_URI');
        $string = explode("/", $url);

        // dd($string);
        if (!$request->expectsJson()) {

            if ($string[1] == "admin") {

                return route('admin.login');
            } else if ($string[1] == "driver") {

                return route('driver.login');
            } else {

                return route('/');
            }
        }
    }
}
