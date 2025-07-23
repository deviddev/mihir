<?php

namespace App\View\Components;

use App\Models\MaterialCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Categories extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = Cache::remember('categories', 60 * 60, function () {
            return MaterialCategory::select(['id', 'name'])
                ->whereHas('materials')
                ->withCount('materials')
                ->orderBy('materials_count', 'desc')
                ->limit(20)
                ->get()
                ->sortBy('name');
        });

        return view('components.categories', compact('categories'));
    }
}
