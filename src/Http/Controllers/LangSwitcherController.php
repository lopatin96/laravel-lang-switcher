<?php

namespace Atin\LaravelLangSwitcher\Http\Controllers;

use Atin\LaravelLangSwitcher\Events\LocaleWasChanged;

class LangSwitcherController extends Controller
{
    public function __invoke(string $locale)
    {
        if (in_array($locale, array_keys(config('laravel-lang-switcher.languages')), true)) {
            session(['locale' => $locale]);

            event(new LocaleWasChanged($locale));
        }

        return redirect()->back();
    }
}
