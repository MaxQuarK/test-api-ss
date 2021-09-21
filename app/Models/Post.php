<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends ExtendedModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_id',
        'category_id',
    ];

    public function category()
    {
        return $this->hasMany('App\Models\Category', 'id', 'category_id');
    }

    public function file()
    {
        return $this->hasOne('App\Models\File', 'id', 'file_id');
    }
}
