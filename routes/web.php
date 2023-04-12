<?php

use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', \Atin\LaravelLangSwitcher\Http\Controllers\LangSwitcherController::class)
    ->name('locale');