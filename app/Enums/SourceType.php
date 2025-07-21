<?php

declare(strict_types=1);

namespace App\Enums;

enum SourceType: string
{
    case Article = 'article';
    case Youtube = 'youtube';
    case Podcast = 'podcast';

    // add translations
    public function label(): string
    {
        return match ($this) {
            SourceType::Youtube => __('misc.youtube'),
            SourceType::Article => __('misc.article'),
            SourceType::Podcast => __('misc.podcast'),
        };
    }
}
