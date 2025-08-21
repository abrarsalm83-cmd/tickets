<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
{
    // dd([
    //     'is_admin' => auth()->check() ? auth()->user()->is_admin : 'غير مسجل',
    //     'user' => auth()->user()
    // ]);

    if (auth()->user()->is_admin != 1) {
        return redirect()->route('home')->with('error', 'You are not an admin.');
    }
    
    return $next($request);

}

}