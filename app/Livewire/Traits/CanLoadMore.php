<?php

declare(strict_types=1);

namespace App\Livewire\Traits;

use Livewire\Attributes\Locked;

trait CanLoadMore
{
    #[Locked]
    public int $perPage = 12;

    public function loadMore(): void
    {
        $this->perPage = min($this->perPage + 6, config('feeds.max_per_page'));
    }
}
