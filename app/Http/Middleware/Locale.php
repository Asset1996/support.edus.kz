<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class Locale
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
        $lang = $request->route()->parameter('lang');

        if (!in_array($lang, config('app.locales'))) {
            abort(404);
        }

        URL::defaults(['lang' => $lang]);  
        session(['locale' => $lang]);
        app()->setLocale($lang);

        return $next($request);
    }
}