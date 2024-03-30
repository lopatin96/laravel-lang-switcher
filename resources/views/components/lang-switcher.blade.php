@props(['align' => 'bottom'])

<x-dropdown align="{{ $align }}" width="40">
    <x-slot name="trigger">
        <span {{ $attributes->merge(['class' => '']) }}>
            {{ __('laravel-lang-switcher::langs.Language') }}: {{ config("laravel-lang-switcher.languages." . app()->getLocale()) }}
        </span>
    </x-slot>

    <x-slot name="content">
        <div class="block px-4 py-2 text-xs text-gray-400 select-none text-center cursor-default">
            {{ __('laravel-lang-switcher::langs.Select language') }}
        </div>

        @foreach(config('laravel-lang-switcher.languages') as $locale => $language)
            <x-dropdown-link
                :href="route('locale', ['locale' => $locale])"
                rel="nofollow"
                class="cursor-pointer {{ $locale === app()->getLocale() ? 'bg-gray-100 font-semibold' : null }}"
            >
                {{ config("laravel-lang-switcher.languages.$locale") }}
            </x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>
