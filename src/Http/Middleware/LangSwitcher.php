<?php

namespace Atin\LaravelLangSwitcher\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;

class LangSwitcher
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth()->check()) {
            app()->setLocale(auth()->user()->locale ?? $this->getLocale($request));

            return $next($request);
        }

        $locale = $this->getLocale($request);

        cookie()->queue(cookie('locale', $locale, config('laravel-lang-switcher.cookie_life_in_minutes', 43200)));
        app()->setLocale($locale);

        return $next($request);
    }

    private function getLocale(Request $request): string
    {
        if (
            ($locale = $request->input('locale'))
            && array_key_exists($locale, config('laravel-lang-switcher.languages'))
        ) {
            return $locale;
        }

        if (
            ($country = $request->input('country'))
            && array_key_exists($country, config('laravel-lang-switcher.countries_to_locales'))
            && array_key_exists(config('laravel-lang-switcher.countries_to_locales')[$country], config('laravel-lang-switcher.languages'))
        ) {
            return config('laravel-lang-switcher.countries_to_locales')[$country];
        }

        if (
            ($locale = $request->cookie('locale'))
            && array_key_exists($locale, config('laravel-lang-switcher.languages'))
        ) {
            return $locale;
        }

        if (
            ($location = Location::get($request->ip()))
            && is_object($location)
            && ($country = Str::lower(Str::limit(Location::get($request->ip())->countryCode, 2, '')))
            && array_key_exists($country, config('laravel-lang-switcher.countries_to_locales'))
            && array_key_exists(config('laravel-lang-switcher.countries_to_locales')[$country], config('laravel-lang-switcher.languages'))
        ) {
            return config('laravel-lang-switcher.countries_to_locales')[$country];
        }

        if (
            ($locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2))
            && array_key_exists($locale, config('laravel-lang-switcher.languages'))
        ) {
            return $locale;
        }

        return config('app.locale', 'en');
    }
}
