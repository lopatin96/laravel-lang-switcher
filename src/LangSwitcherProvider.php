<?php

namespace Atin\LaravelLangSwitcher;

use Atin\LaravelLangSwitcher\Providers\EventServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Registered;

class LangSwitcherProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app->register(EventServiceProvider::class);

        \Event::listen(Registered::class, static function ($event) {
            $event->user->forceFill([
                'locale' => request()->cookie('locale'),
            ])->save();
        });

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-lang-switcher');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'laravel-lang-switcher');

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-lang-switcher');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('/migrations')
        ], 'laravel-lang-switcher-migrations');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-lang-switcher')
        ], 'laravel-lang-switcher-views');

        $this->publishes([
            __DIR__.'/../resources/images' => public_path('images/vendor/laravel-lang-switcher'),
        ], 'laravel-lang-switcher-images');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/laravel-lang-switcher'),
        ], 'laravel-lang-switcher-lang');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('laravel-lang-switcher.php')
        ], 'laravel-lang-switcher-config');
    }
}