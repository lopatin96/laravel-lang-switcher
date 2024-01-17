<?php

namespace Atin\LaravelLangSwitcher\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangSwitcher
{
    public function handle(Request $request, Closure $next): mixed
    {
        $locale = $request->input('lang')
            ?? $request->session()->get('locale', 'en')
            ?? substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        if (! array_key_exists($locale, config('laravel-lang-switcher.languages'))) {
            $locale = config('app.locale');
        }

        session(['locale' => $locale]);

        App::setLocale($locale);

        return $next($request);
    }
}
