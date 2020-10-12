<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
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
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Acces-Controll-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
            'Acces-Controll-Allow-Credentials' => 'true',
            'Acces-Controll-Allow-Max-Age' => '86400',
            'Acces-Controll-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With'
        ];

        if($request->isMethod('OPTIONS'))
        {
            return response()->json('{"method": "OPTIONS"}', 200, $headers);
        }

        $response = $next($request);

        foreach($headers as $key => $value)
        {
            $response->header($key, $value);
        }


        return $next($request);
    }
}