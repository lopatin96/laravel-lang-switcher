<?php

namespace Atin\LaravelLangSwitcher\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangSwitcher
{
    public function handle(Request $request, Closure $next): mixed
    {
        $lang = $request->input('lang')
            ?? request()->cookie('page_lang')
            ?? substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        App::setLocale(
            array_key_exists($lang, config('laravel-lang-switcher.languages'))
                ? $lang
                : config('app.locale', 'en')
        );

        return $next($request);
    }
}
