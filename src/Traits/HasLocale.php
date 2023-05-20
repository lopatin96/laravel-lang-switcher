<?php

namespace Atin\LaravelLangSwitcher\Traits;

use Atin\LaravelLangSwitcher\Models\SocialAccount;

trait HasLocale
{
    public function locale()
    {
        return $this->locale ?? 'en';
    }
}