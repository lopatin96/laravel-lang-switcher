<?php

namespace Atin\LaravelLangSwitcher\Listeners;

use App\Events\Event;
use Illuminate\Support\Facades\App;

class UpdateUserLocale
{
    public function handle(): void
    {
        if (auth()->check()) {
            auth()->user()->locale = App::getLocale();
            auth()->user()->save();
        }
    }
}