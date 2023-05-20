<?php

namespace Atin\LaravelLangSwitcher\Listeners;

use Atin\LaravelLangSwitcher\Events\LocaleWasChanged;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\App;

class UpdateUserLocale
{
    public function handle(LocaleWasChanged|Login $event)
    {
        if (auth()->check()) {
            auth()->user()->locale = $event->locale ?? App::getLocale();
            auth()->user()->save();
        }
    }
}