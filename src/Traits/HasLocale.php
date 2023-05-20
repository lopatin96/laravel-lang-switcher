<?php

namespace Atin\LaravelSocialAuth\Traits;

use Atin\LaravelSocialAuth\Models\SocialAccount;

trait HasLocale
{
    public function locale()
    {
        return $this->locale ?? 'en';
    }
}