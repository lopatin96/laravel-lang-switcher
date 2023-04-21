@props(['align' => 'bottom'])

<x-dropdown align="{{ $align }}" width="40">
    <x-slot name="trigger">
        <span class="text-gray-500 hover:text-gray-700 font-medium cursor-pointer">
            {{ __('laravel-lang-switcher::langs.Language') }}
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
                class="cursor-pointer {{ $locale === session()->get('locale') ? 'bg-gray-100 font-semibold' : null }}"
            >
                {{ config("laravel-lang-switcher.languages.$locale") }}
            </x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>