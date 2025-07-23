<?php

declare(strict_types=1);

namespace App\Livewire\Materials;

use App\Livewire\Traits\CanLoadMore;
use App\Models\Material;
use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class Index extends Component
{
    use CanLoadMore;

    public function mount()
    {
        if (auth()->check() && ! auth()->user()->hasVerifiedEmail()) {
            $this->redirect(route('verification.notice', absolute: false), navigate: true);
        }
    }

    public function render(Request $request)
    {
        return view('livewire.materials.index', [
            'materials' => Material::displayed()
                ->latest('published_at')
                ->when($request->category, function ($query) use ($request) {
                    $query->where('category_id', $request->category);
                })
                ->select([
                    'id',
                    'slug',
                    'published_at',
                ])
                ->cursorPaginate($this->perPage),
        ]);
    }
}
