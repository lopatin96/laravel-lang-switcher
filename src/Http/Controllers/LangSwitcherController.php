<?php

namespace Atin\LaravelLangSwitcher\Http\Controllers;

class LangSwitcherController extends Controller
{
    public function __invoke(string $locale)
    {
        if (in_array($locale, ['en', 'ru'], true)) {
            session(['locale' => $locale]);
        }

        return redirect()->back();
    }
}
