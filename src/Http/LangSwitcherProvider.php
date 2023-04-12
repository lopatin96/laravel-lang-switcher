<?php

namespace Atin\LaravelLangSwitcher;

use Illuminate\Support\ServiceProvider;

class LangSwitcherProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-lang-switcher');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'laravel-lang-switcher');
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-lang-switcher');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-lang-switcher')
        ], 'laravel-lang-switcher-views');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/laravel-lang-switcher'),
        ], 'laravel-lang-switcher-lang');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('laravel-lang-switcher.php')
        ], 'laravel-lang-switcher-config');
    }
}