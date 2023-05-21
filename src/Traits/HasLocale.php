<?php

namespace Atin\LaravelLangSwitcher\Traits;

trait HasLocale
{
    public function locale()
    {
        return array_key_exists($this->locale, config('laravel-lang-switcher.languages')) ? $this->locale : config('app.locale');
    }
}