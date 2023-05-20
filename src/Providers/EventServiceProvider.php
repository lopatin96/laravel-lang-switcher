<?php

namespace Atin\LaravelLangSwitcher\Providers;

use Atin\LaravelLangSwitcher\Events\LocaleWasChanged;
use Atin\LaravelLangSwitcher\Listeners\UpdateUserLocale;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        LocaleWasChanged::class => [
            UpdateUserLocale::class,
        ],
        Login::class => [
            UpdateUserLocale::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();
    }
}