<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class MaterialCategory extends Model
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
}
