<?php

namespace Atin\LaravelLangSwitcher\Listeners;

use Atin\LaravelLangSwitcher\Events\LocaleWasChanged;

class UpdateUserLocale
{
    public function handle(LocaleWasChanged $event)
    {
        if (auth()->check()) {
            auth()->user()->locale = $event->locale;
            auth()->user()->save();
        }
    }
}