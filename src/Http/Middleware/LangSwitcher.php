<?php

namespace Atin\LaravelLangSwitcher\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangSwitcher
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth()->check()) {
            app()->setLocale(auth()->user()->locale);

            return $next($request);
        }

        foreach ([
            $request->input('locale'),
            $request->input('country') ? config('laravel-lang-switcher.countries_to_locales')[$request->input('country')] ?? null : null,
            request()->cookie('locale'),
            substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2) ?? null,
            config('app.locale', 'en'),
        ] as $locale) {
            if (array_key_exists($locale, config('laravel-lang-switcher.languages'))) {
                cookie()->queue(cookie('locale', $locale, config('laravel-lang-switcher.cookie_life_in_minutes', 43200)));
                app()->setLocale($locale);
                break;
            }
        }

        return $next($request);
    }
}
