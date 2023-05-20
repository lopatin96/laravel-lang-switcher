<?php

namespace Atin\LaravelLangSwitcher\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class LocaleWasChanged
{
    use Dispatchable;

    public function __construct()
    {
    }
}