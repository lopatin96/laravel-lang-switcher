<?php

namespace Atin\LaravelLangSwitcher\Http\Controllers;

use Atin\LaravelLangSwitcher\Events\LocaleWasChanged;

class LangSwitcherController extends Controller
{
    public function __invoke(string $locale)
    {
        if (array_key_exists($locale, config('laravel-lang-switcher.languages'))) {
            cookie()->queue(cookie('locale', $locale, config('laravel-lang-switcher.cookie_life_in_minutes', 43200)));

            event(new LocaleWasChanged($locale));
        }

        if (in_array(url()->previousPath(), $this->getLangKeysToRedirect(), true)) {
            return redirect("/$locale");
        }

        return redirect(url()->previousPath());
    }

    private function getLangKeysToRedirect(): array
    {
        return array_merge(['/'], array_map(fn($langKey) => "/$langKey", array_keys(config('laravel-lang-switcher.languages'))));
    }
}
