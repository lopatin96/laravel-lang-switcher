<?php

namespace Atin\LaravelLangSwitcher\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangSwitcher
{
    public function handle(Request $request, Closure $next): mixed
    {
        foreach ([
            $request->input('locale'),
            $request->input('country') ? config('laravel-lang-switcher.countries_to_locales')[$request->input('country')] ?? null : null,
            request()->cookie('locale'),
            auth()->user()?->locale ?? null,
            substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2) ?? null,
            config('app.locale', 'en'),
        ] as $lang) {
            if (array_key_exists($lang, config('laravel-lang-switcher.languages'))) {
                cookie()->queue(cookie('locale', $lang, config('laravel-lang-switcher.cookie_life_in_minutes', 43200)));
                app()->setLocale($lang);
                break;
            }
        }

        return $next($request);
    }
}
