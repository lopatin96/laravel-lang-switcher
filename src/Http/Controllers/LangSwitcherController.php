<?php

namespace Atin\LaravelLangSwitcher\Http\Controllers;

use Atin\LaravelLangSwitcher\Events\LocaleWasChanged;
use Atin\LaravelLangSwitcher\Helpers\LaravelLangSwitcherHelper;
use Atin\LaravelLangSwitcher\Http\LangSwitcher;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LangSwitcherController extends Controller
{
    public function index(?string $locale = null): View|RedirectResponse
    {
        $currentLocale = LaravelLangSwitcherHelper::getLocale();

        if ($locale !== $currentLocale) {
            event(new LocaleWasChanged($currentLocale));

            return redirect()->to("/$currentLocale" . (request()->getQueryString() ? '?' . request()->getQueryString() : ''));
        }

        return view(view()->exists('pages.index') ? 'pages.index' : 'laravel-pages::pages.index', [
            'page' => 'index',
        ]);
    }

    public function locale(string $locale)
    {
        event(new LocaleWasChanged($locale));

        if (in_array(url()->previousPath(), LaravelLangSwitcherHelper::getLangKeysToRedirect(), true)) {
            return redirect("/$locale");
        }

        return redirect(url()->previousPath());
    }
}
