<div class="flex flex-row flex-wrap gap-1.5 text-xs mb-4">
    @foreach ($categories as $category)
        <a href="{{ route('materials.index', ['category' => $category->slug]) }}"
            class="bg-secondary dark:bg-secondary/50 text-white px-2 py-1 rounded">{{ $category->name }}</a>
    @endforeach
</div>
