@props(['align' => 'bottom'])

<x-dropdown align="{{ $align }}" width="36">
    <x-slot name="trigger">
        <div class="flex flex-col leading-tight cursor-pointer">
            <span class="text-xs font-mono opacity-75">change language</span>

            <span {{ $attributes->merge(['class' => '']) }}>
                {{ __('laravel-lang-switcher::langs.Language') }}: {{ config("laravel-lang-switcher.languages." . app()->getLocale()) }}
            </span>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="block px-4 py-2 text-xs text-gray-400 select-none text-center cursor-default">
            {{ __('laravel-lang-switcher::langs.Select language') }}
        </div>

        @foreach(config('laravel-lang-switcher.languages') as $locale => $language)
            <x-dropdown-link
                :href="route('locale', ['locale' => $locale])"
                rel="nofollow"
                class="flex items-center space-x-2 cursor-pointer {{ $locale === app()->getLocale() ? 'bg-gray-300 font-semibold animate-pulse' : null }}"
            >
                <img
                    class="w-5 rounded border"
                    src="{{ asset('images/vendor/laravel-lang-switcher/' . $locale . '.svg') }}"
                    alt="lang flag of {{ $locale }}"
                />

                <span>
                    {{ config("laravel-lang-switcher.languages.$locale") }}
                </span>
            </x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>
