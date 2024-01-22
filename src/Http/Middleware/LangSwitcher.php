<?php

namespace Atin\LaravelLangSwitcher\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangSwitcher
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (array_key_exists($request->input('lang') ?? request()->cookie('page_lang'), config('laravel-lang-switcher.languages'))) {
            $pageLang = request()->cookie('page_lang');
        }

        $locale = $request->session()->get('locale', 'en')
            ?? $pageLang
            ?? substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

        if (! array_key_exists($locale, config('laravel-lang-switcher.languages'))) {
            $locale = config('app.locale');
        }

        session(['locale' => $locale]);

        App::setLocale($locale);

        return $next($request);
    }
}
