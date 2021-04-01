<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'ID';

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category','parent_ID','ID');
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
