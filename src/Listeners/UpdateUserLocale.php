<?php

namespace Atin\LaravelLangSwitcher\Listeners;

use Atin\LaravelLangSwitcher\Events\LocaleWasChanged;
use Illuminate\Auth\Events\Login;

class UpdateUserLocale
{
    public function handle(LocaleWasChanged|Login $event)
    {
        if (auth()->check()) {
            auth()->user()->locale = $event->locale ?? app()->getLocale();
            auth()->user()->save();
        }
    }
}