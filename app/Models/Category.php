<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'ID';

    /**
     * Determine relationship between category and article
     *
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany('App\Models\Article');
    }
}
