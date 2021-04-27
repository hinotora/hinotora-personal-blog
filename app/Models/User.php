<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $primaryKey = 'ID';

    /**
     * Determine relationship between article and user.
     *
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany('App\Models\Article');
    }
}
