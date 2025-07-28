<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class MaterialCategory extends Model implements Sitemapable
{
    protected $fillable = ['name', 'slug'];

    protected static function booted(): void
    {
        static::saving(function (MaterialCategory $category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class, 'category_id', 'id');
    }

    public function toSitemapTag(): Url|string|array
    {
        return Url::create(route('home.category', $this))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.5);
    }
}
