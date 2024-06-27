<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetAreaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $area = session()->get('area') ?? config('locale.area');

        session()->put('area', $area);

        return $next($request);
    }
}
