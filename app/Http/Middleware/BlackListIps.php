<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class BlackListIps
{
   
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  
    public function handle(Request $request, Closure $next): Response
    {
        // $blacklistIps = new Collection(['127.0.0.1' , '127.0.0.0' , '127.0.0.2']);
        // if($blacklistIps->contains($request->ip())) 
        //     abort(403 , 'You are ip address '.$request->ip() .' is Blocked');
        return $next($request);
    }
}
