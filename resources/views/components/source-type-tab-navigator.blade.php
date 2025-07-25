<div x-data role="tablist"
    class="tabs tabs-boxed border border-primary bg-transparent w-fit mb-6 items-center justify-center">
    <a role="tab" href="{{ route('home') }}" wire:navigate class="tab"
        x-bind:class="{
            'tab-active !text-white': location.href === '{{ route('home') }}',
            '!text-inherit': location.href !== '{{ route('home') }}'
        }">
        {{ __('misc.all') }}
    </a>

    @foreach ($sourceTypes as $type)
        <a role="tab" href="{{ route('feed.type', $type) }}" wire:navigate class="tab"
            x-bind:class="{
                'tab-active !text-white': location.href === '{{ route('feed.type', $type) }}',
                '!text-inherit': location.href !== '{{ route('feed.type', $type) }}'
            }">
            {{ $type->label() }}
        </a>
    @endforeach
</div>
