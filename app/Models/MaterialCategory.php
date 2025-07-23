<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaterialCategory extends Model
{
    protected $fillable = ['name'];

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }
}
