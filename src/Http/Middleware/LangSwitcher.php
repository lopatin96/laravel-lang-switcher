<?php

namespace Atin\LaravelLangSwitcher\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangSwitcher
{
    public function handle(Request $request, Closure $next): mixed
    {
        $lang = $request->input('locale')
            ?? $request->input('country')
            ?? request()->cookie('locale')
            ?? auth()->user()->locale
            ?? substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        app()->setLocale(
            array_key_exists($lang, config('laravel-lang-switcher.languages'))
                ? $lang
                : config('app.locale', 'en')
        );

        return $next($request);
    }
}
