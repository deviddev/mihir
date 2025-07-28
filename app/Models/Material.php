<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SourceType;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Uri;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Reaction;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class Material extends Model implements Sitemapable
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory, Markable;

    public const DISLIKE_REACTION = 'material.dislike';

    protected $appends = [
        'thumbnail',
    ];

    protected static $marks = [
        Like::class,
        Bookmark::class,
        Reaction::class,
    ];

    public static function feedQuery(): Builder
    {
        return static::query()
            ->displayed()
            ->latest('published_at')
            ->select([
                'id',
                'source_id',
                'title',
                'description',
                'body',
                'slug',
                'url',
                'image_url',
                'published_at',
                'duration',
                'category_id',
                'title_slug',
            ])
            ->with([
                'source:id,publisher_id,type' => [
                    'publisher:id,name,slug,logo',
                ],
            ]);
    }

    public function thumbnail(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                if (blank($this->image_url)) {
                    return asset(
                        str($this->loadMissing('source.publisher')->source->publisher->logo)->prepend('storage/')
                    );
                }

                if (str($this->image_url)->isUrl()) {
                    return $this->image_url;
                }

                return asset(
                    str($this->image_url)->prepend('storage/')
                );
            }
        )->shouldCache();
    }

    public function urlWithUtms(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                if ($this->isArticle()) {
                    return Uri::of($this->url)
                        ->withQuery([
                            'utm_source' => parse_url(config('app.url'), PHP_URL_HOST),
                            'utm_medium' => 'referral',
                            'utm_campaign' => 'referral',

                        ])->value();
                }

                return $this->url;
            }
        )->shouldCache();
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MaterialCategory::class, 'category_id', 'id');
    }

    public function scopeDisplayed(Builder $query): void
    {
        $query
            ->where("{$this->getTable()}.is_displayed", 1)
            ->whereHas('source', fn(Builder $q) => $q->displayed());
    }

    public function scopeNotDisplayed(Builder $query): void
    {
        $query->where("{$this->getTable()}.is_displayed", 0);
    }

    public function scopeSlug(Builder $query, string $slug): void
    {
        $query->where('slug', $slug);
    }

    public function scopeSourceType(Builder $query, SourceType $sourceType): void
    {
        $query->whereRelation('source', 'type', $sourceType);
    }

    public function isArticle(): bool
    {
        return $this->source->type === SourceType::Article;
    }

    public function isYoutube(): bool
    {
        return $this->source->type === SourceType::Youtube;
    }

    public function isPodcast(): bool
    {
        return $this->source->type === SourceType::Podcast;
    }

    protected static function booted(): void
    {
        static::creating(function (Material $material) {
            $material->slug = Str::random();
            $baseSlug = Str::slug(str($material->title)->words(15));
            $slug = $baseSlug;
            $counter = 1;

            while (Material::where('title_slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }

            $material->title_slug = $slug;
        });
    }

    protected function casts(): array
    {
        return [
            'is_displayed' => 'boolean',
            'published_at' => 'datetime',
            'duration' => 'integer',
            'duplicate_sources' => 'array',
        ];
    }

    public function toSitemapTag(): Url|string|array
    {
        return Url::create(route('home.material', ['year' => $this->published_at->year, 'month' => $this->published_at->month, 'material' => $this->title_slug]))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }
}
