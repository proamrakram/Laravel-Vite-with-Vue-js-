<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetAppLocal
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
        $local = $request->query('lang', session('lang', 'ar'));

        if ($local == 'ar') {
            session()->put('dir', 'rtl');
        } else {
            session()->put('dir', 'ltr');
        }

        session()->put('lang', $local);

        App::setLocale($local);

        return $next($request);
    }
}
