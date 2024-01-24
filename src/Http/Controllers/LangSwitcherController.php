<?php

namespace Atin\LaravelLangSwitcher\Http\Controllers;

use Atin\LaravelLangSwitcher\Events\LocaleWasChanged;

class LangSwitcherController extends Controller
{
    public function __invoke(string $locale)
    {
        if (array_key_exists($locale, config('laravel-lang-switcher.languages'))) {
            cookie()->queue(cookie('page_lang', $locale, config('laravel-lang-switcher.cookie_life_in_minutes', 43200)));

            event(new LocaleWasChanged($locale));
        }

        return redirect(url()->previousPath());
    }
}
