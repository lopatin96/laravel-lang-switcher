<?php

namespace Atin\LaravelLangSwitcher\Http\Controllers;

use Atin\LaravelLangSwitcher\Events\LocaleWasChanged;

class LangSwitcherController extends Controller
{
    public function __invoke(string $locale)
    {
        if (array_key_exists($locale, config('laravel-lang-switcher.languages'))) {
            session(['locale' => $locale]);

            event(new LocaleWasChanged());
        }

        return redirect()->back();
    }
}
