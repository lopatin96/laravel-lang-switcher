<?php

namespace Atin\LaravelLangSwitcher\Http\Controllers;

class LangSwitcherController extends Controller
{
    public function __invoke(string $locale)
    {
        if (in_array($locale, array_keys(config('laravel-lang-switcher.languages')), true)) {
            session(['locale' => $locale]);

            if (auth()->check()) {
                auth()->user()->locale = $locale;
                auth()->user()->save();
            }
        }

        return redirect()->back();
    }
}
