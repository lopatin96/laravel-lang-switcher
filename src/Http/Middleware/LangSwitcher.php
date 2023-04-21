<?php

namespace Atin\LaravelLangSwitcher\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangSwitcher
{
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale', 'en');
        } else {
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            $supportedLocales = ['en', 'ru'];

            if (! in_array($locale, $supportedLocales, true)) {
                $locale = 'en';
            }
        }

        session(['locale' => $locale]);
        App::setLocale($locale);

        return $next($request);
    }
}
