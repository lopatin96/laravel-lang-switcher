<?php

namespace Atin\LaravelLangSwitcher\Http\Middleware;

use Atin\LaravelLangSwitcher\Events\LocaleWasChanged;
use Atin\LaravelLangSwitcher\Helpers\LaravelLangSwitcherHelper;
use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Str;

class LangSwitcher
{
    public function handle(Request $request, Closure $next): mixed
    {
        $locale = LaravelLangSwitcherHelper::getLocale();

        if (auth()->guest()) {
            cookie()->queue(cookie('locale', $locale, config('laravel-lang-switcher.cookie_life_in_minutes', 43200)));
        } else if ($locale !== auth()->user()->locale) {
            event(new LocaleWasChanged($locale));
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
