<?php

namespace App\View\Components;

use App\Models\Material;
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
            return MaterialCategory::select(['id', 'name', 'slug'])
                ->whereHas('materials')
                ->withCount('materials')
                ->orderBy('materials_count', 'desc')
                ->limit(20)
                ->get()
                ->sortBy('name');
        });


        $withoutCategory = Cache::remember('without_category', 60 * 60, function () {
            return Material::query()
                ->whereNull('category_id')
                ->count();
        });

        return view('components.categories')
            ->with('categories', $categories)
            ->with('withoutCategory', $withoutCategory);
    }
}
