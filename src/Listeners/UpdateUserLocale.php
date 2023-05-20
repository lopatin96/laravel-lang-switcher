<?php

namespace Atin\LaravelLangSwitcher\Listeners;

use App\Events\Event;
use Illuminate\Support\Facades\App;

class UpdateUserLocale
{
    public function handle(Event $event)
    {
        if (auth()->check()) {
            auth()->user()->locale = $event->locale ?? App::getLocale();
            auth()->user()->save();
        }
    }
}