<?php

namespace App\Http\Middleware;

use Closure;
use App\Providers\JSONResponseProvider;

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
        $response = new JSONResponseProvider;
        $lang = $request->route()->parameter('lang');

        if (!in_array($lang, config('app.locales'))) {
            return $response->error(_('Not found'), 404);
        }

        session(['locale' => $lang]);
        app()->setLocale($lang);

        return $next($request);
    }
}