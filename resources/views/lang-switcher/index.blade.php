<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        <span class="text-gray-400 hover:text-gray-600 font-medium leading-relaxed cursor-pointer">
            {{ __('Language') }}
        </span>
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute z-50 mt-2 w-40 rounded-md shadow-lg origin-top-right right-0"
         style="display: none;"
         @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
            <div class="block px-4 py-2 text-xs text-gray-400 select-none text-center cursor-default">
                {{ __('Select language') }}
            </div>

            @foreach(['en', 'ru'] as $locale)
                <x-jet-dropdown-link
                        :href="route('locale', ['locale' => $locale])"
                        rel="nofollow"
                        class="cursor-pointer {{ $locale === session()->get('locale') ? 'bg-gray-100 font-semibold' : null }}"
                >
                    {{ __($locale) }}
                </x-jet-dropdown-link>
            @endforeach
        </div>
    </div>
</div>