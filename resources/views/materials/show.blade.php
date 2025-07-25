<x-layouts.guest>
    <div class="space-y-8 max-w-5xl mx-auto">
        <div class="flex justify-between items-center">
            <div class="avatar">
                <a class="absolute size-full inset-0"
                    href="{{ route('publishers.show', $material->source->publisher->slug) }}" wire:navigate></a>
                <div class="w-12 rounded-full">
                    <img loading="lazy" src="{{ asset('storage/' . $material->source->publisher->logo) }}" />
                </div>
            </div>
            <div class="relative">
                <a class="absolute size-full inset-0" href="{{ route('feed.type', $material->source->type) }}"
                    wire:navigate></a>
                @if ($material->isArticle())
                    <span class="inline-flex items-center justify-center mx-0 size-12 rounded-full bg-stone-700">
                        <x-heroicon-o-pencil-square class="inline size-6 stroke-white" />
                    </span>
                @elseif ($material->isYoutube())
                    <span class="inline-flex items-center justify-center mx-0 size-12 rounded-full bg-red-500">
                        <x-heroicon-o-video-camera class="inline size-6 stroke-white fill-white" />
                    </span>
                @elseif ($material->isPodcast())
                    <span class="inline-flex items-center justify-center mx-0 size-12 rounded-full bg-purple-500">
                        <x-heroicon-o-microphone class="inline size-6 stroke-white" />
                    </span>
                @endif
            </div>
        </div>
        <div>
            <div class="flex max-sm:flex-col sm:items-center gap-x-1 text-sm opacity-70 mb-2">
                <div>
                    {{ $material->source->publisher->name }}
                </div>
                <div class="max-sm:hidden">
                    ·
                </div>
                <div class="max-sm:opacity-60">
                    {{ $material->published_at->inUserTimezone()->toFormattedDateString() }}
                </div>
                @if (filled($material->duration))
                    <div class="max-sm:hidden">
                        ·
                    </div>
                    <div class="max-sm:hidden">
                        {{ Carbon\CarbonInterval::seconds($material->duration)->cascade()->forHumans(['short' => true]) }}
                    </div>
                @endif
            </div>
            <h1 class="font-bold text-2xl lg:text-3xl">
                {!! $material->title !!}
            </h1>
            <h2 class="opacity-85 line-clamp-2">
                {!! str($material->description)->stripTags() !!}
            </h2>
        </div>
        @if ($material->isArticle())
            <figure>
                <img loading="lazy" src="{{ $material->thumbnail }}" alt=""
                    class="rounded-box size-full shadow-2xl">
            </figure>
            <div
                class="prose prose-img:hidden prose-figure:hidden prose-video:hidden dark:text-stone-400 dark:prose-a:text-stone-500 dark:prose-headings:text-stone-300">
                {!! $material->body !!}
            </div>
        @elseif ($material->isYoutube())
            <x-youtube-player :material="$material" />
        @elseif ($material->isPodcast())
            <x-podcast-player :material="$material" />
        @endif

        <div class="flex justify-between items-center">
            <div class="flex items-center gap-x-2 lg:gap-x-6">
                <div class="relative lg:tooltip" x-bind:class="{ 'lg:tooltip-open': isCopied }"
                    x-bind:data-tip="isCopied && 'Link Copied!'" x-data="copyLink('{{ $material->url }}')">
                    <button class="flex items-center" x-on:click="copy">
                        <x-heroicon-o-link class="inline-flex lg:size-8 size-6 hover:stroke-primary"
                            x-bind:class="{
                                'stroke-primary': isCopied,
                                'stroke-stone-800 dark:stroke-stone-300': !isCopied
                            }" />
                    </button>
                </div>
            </div>
            @if ($material->category)
                <a href="{{ route('home.category', ['category' => $material->category->slug]) }}"
                    class="bg-secondary dark:bg-secondary/50 text-white px-2 py-1 rounded">
                    {{ $material->category->name }}
                </a>
            @endif
            @if ($material->isArticle())
                <div>
                    <a class="btn max-lg:btn-sm max-lg:text-xs btn-primary btn-outline hover:!text-white"
                        href="{{ $material->urlWithUtms }}" target="_blank">
                        <x-heroicon-o-arrow-top-right-on-square class="lg:size-6 size-4" />
                        <span>
                            {{ __('misc.read_post') }}
                        </span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.guest>
