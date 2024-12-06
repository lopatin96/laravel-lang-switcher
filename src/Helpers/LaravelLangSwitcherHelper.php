<?php

namespace Atin\LaravelLangSwitcher\Helpers;

use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class LaravelLangSwitcherHelper
{
    public static function getLangKeysToRedirect(): array
    {
        return array_merge(['/'], array_map(fn($langKey) => "/$langKey", array_keys(config('laravel-lang-switcher.languages'))));
    }

    public static function getLocale(): string
    {
        if (array_key_exists(request()->path(), config('laravel-lang-switcher.languages'))) {
            return request()->path();
        }

        if (
            auth()->check()
            && ($locale = auth()->user()->locale)
            && array_key_exists($locale, config('laravel-lang-switcher.languages'))
        ) {
            return $locale;
        }
        if (
            ($locale = request()->path())
            && array_key_exists($locale, config('laravel-lang-switcher.languages'))
        ) {
            return $locale;
        }

        if (
            ($locale = request()->cookie('locale'))
            && array_key_exists($locale, config('laravel-lang-switcher.languages'))
        ) {
            return $locale;
        }

        if (
            ($location = Location::get(request()->ip()))
            && is_object($location)
            && ($country = Str::lower(Str::limit(Location::get(request()->ip())->countryCode, 2, '')))
            && array_key_exists($country, config('laravel-lang-switcher.countries_to_locales'))
            && array_key_exists(config('laravel-lang-switcher.countries_to_locales')[$country], config('laravel-lang-switcher.languages'))
        ) {
            return config('laravel-lang-switcher.countries_to_locales')[$country];
        }

        if (
            ($locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2))
            && array_key_exists($locale, config('laravel-lang-switcher.languages'))
        ) {
            return $locale;
        }

        return config('app.locale', 'en');
    }
}
