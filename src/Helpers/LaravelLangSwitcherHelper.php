<?php

namespace Atin\LaravelLangSwitcher\Helpers;

class LaravelLangSwitcherHelper
{
    public static function getLangKeysToRedirect(): array
    {
        return array_merge(['/'], array_map(fn($langKey) => "/$langKey", array_keys(config('laravel-lang-switcher.languages'))));
    }
}
