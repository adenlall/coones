<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RobotsTxtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         if ($request->is('robots.txt')) {
            return response(file_get_contents(public_path('robots.txt')))
                ->header('Content-Type', 'text/plain');
        }
        dd("work on progress ...");
        return $next($request);
   }
}
