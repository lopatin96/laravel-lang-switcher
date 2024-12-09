@props(['align' => 'bottom'])

<x-dropdown align="{{ $align }}" width="72">
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

        <div class="grid grid-cols-2">
            @php
                $languages = config('laravel-lang-switcher.languages');
                $half = ceil(count($languages) / 2);
                $firstHalf = array_slice($languages, 0, $half, true);
                $secondHalf = array_slice($languages, $half, null, true);
            @endphp

            @foreach([$firstHalf, $secondHalf] as $chunk)
                @foreach($chunk as $locale => $language)
                    <x-dropdown-link
                        :href="route('locale', ['locale' => $locale])"
                        rel="nofollow"
                        class="flex items-center space-x-2 cursor-pointer {{ $locale === app()->getLocale() ? 'bg-gray-300 font-semibold animate-pulse' : null }}"
                    >
                        <img
                            class="w-5 rounded border"
                            src="{{ asset('images/vendor/laravel-lang-switcher/' . $locale . '.svg') }}"
                            loading="lazy"
                            alt="lang flag of {{ $locale }}"
                        />
                        <span>
                            {{ config("laravel-lang-switcher.languages.$locale") }}
                        </span>
                    </x-dropdown-link>
                @endforeach
            @endforeach
        </div>
    </x-slot>
</x-dropdown>
