<div class="w-1/5 max-lg:hidden">
    <div class="fixed py-6 flex flex-col space-y-12 h-screen w-fit">
        <figure class="h-12 flex items-center">
            <a wire:navigate href="{{ auth()->check() ? route('materials.index') : route('home') }}">
                <img loading="lazy" class="sm:w-52 w-48 p-4" src="{{ asset('img/logo.png') }}" alt="Larasense logo">
            </a>
        </figure>
        <div class="space-y-4">
            <a wire:navigate href="{{ route('materials.index') }}" @class([
                'flex items-center gap-x-3 p-3 font-semibold',
                'bg-primary text-white rounded-btn' => request()->routeIs([
                    'feed',
                    'materials.index',
                ]),
                'hover:bg-accent dark:hover:bg-stone-900 hover:rounded' => !request()->routeIs(
                    ['feed', 'materials.index']),
            ])>
                <x-heroicon-o-home class="inline-block size-6" />
                <span>
                    {{ __('nav.home') }}
                </span>
            </a>
            <a wire:navigate href="{{ route('likes') }}" @class([
                'flex items-center gap-x-3 p-3 font-semibold',
                'bg-primary text-white rounded-btn' => request()->routeIs('likes'),
                'hover:bg-accent dark:hover:bg-stone-900 hover:rounded' => !request()->routeIs(
                    'likes'),
            ])>
                <x-heroicon-o-hand-thumb-up class="inline-block size-6" />
                <span>
                    {{ __('nav.likes') }}
                </span>
            </a>
            <a wire:navigate href="{{ route('bookmarks') }}" @class([
                'flex items-center gap-x-3 p-3 font-semibold',
                'bg-primary text-white rounded-btn' => request()->routeIs('bookmarks'),
                'hover:bg-accent dark:hover:bg-stone-900 hover:rounded' => !request()->routeIs(
                    'bookmarks'),
            ])>
                <x-heroicon-o-bookmark class="inline-block size-6" />
                <span>
                    {{ __('nav.bookmarks') }}
                </span>
            </a>
            <a wire:navigate href="{{ route('settings') }}" @class([
                'flex items-center gap-x-3 p-3 font-semibold',
                'bg-primary text-white rounded-btn' => request()->routeIs('settings'),
                'hover:bg-accent dark:hover:bg-stone-900 hover:rounded' => !request()->routeIs(
                    'settings'),
            ])>
                <x-heroicon-o-cog-6-tooth class="inline-block size-6" />
                <span>
                    {{ __('nav.settings') }}
                </span>
            </a>
        </div>
        <div class="flex-1 flex flex-col justify-end items-start">
            <button x-data class="btn btn-sm btn-primary btn-link"
                x-on:click="$dispatch('open-source-suggestions-modal')">
                {{ __('nav.suggest_sources') }}
            </button>
            <button x-data class="btn btn-sm btn-primary btn-link" x-on:click="$dispatch('open-bug-reports-modal')">
                {{ __('nav.report_bugs') }}
            </button>
            <a href="{{ route('terms') }}"
                class="btn btn-sm btn-primary btn-link">{{ __('misc.terms_and_conditions') }}</a>
            <a href="{{ route('privacy') }}"
                class="btn btn-sm btn-primary btn-link">{{ __('misc.privacy_policy') }}</a>
            <a href="https://github.com/deviddev/mihir" target="_blank"
                class="btn btn-sm btn-primary btn-link">Github</a>
        </div>
    </div>
</div>
