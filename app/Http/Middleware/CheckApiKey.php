<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->input('api_key') !== env('USSD_API_KEY'))         
        {         
            $response = ['response' => "0000"];    
            return response()->json($response, 401);   
        }

        return $next($request);


    }
}
