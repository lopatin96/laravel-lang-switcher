<?php

use Atin\LaravelLangSwitcher\Http\Controllers\LangSwitcherController;

Route::get('/locale/{locale}', LangSwitcherController::class)
    ->whereIn('locale', array_values(config('laravel-lang-switcher.countries_to_locales')))
    ->name('locale');

Route::get('/{locale}', function ($locale) {
    if (! in_array($locale, config('laravel-lang-switcher.countries_to_locales'))) {
        return Redirect::to('/');
    }

    if (! request()->cookie('locale')) {
        cookie()->queue(cookie('locale', $locale, config('laravel-lang-switcher.cookie_life_in_minutes', 43200)));
    }

    app()->setLocale(request()->cookie('locale') ?? $locale);

    return view('laravel-pages::pages.index', [
        'page' => 'index',
    ]);
})
    ->whereIn('locale', array_values(config('laravel-lang-switcher.countries_to_locales')));

