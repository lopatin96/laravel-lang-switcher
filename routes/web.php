<?php

use Atin\LaravelLangSwitcher\Http\Controllers\LangSwitcherController;

Route::group([
    'prefix' => '{locale?}',
    'where' => ['locale' => implode('|', array_keys(config('laravel-lang-switcher.languages')))]
], static function () {
    Route::get('/', [LangSwitcherController::class, 'index']);

    Route::get('/locale', [LangSwitcherController::class, 'locale'])
        ->name('locale');
});
