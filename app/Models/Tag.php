<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'image',
        'title',
        'category',
        'url_title',
        'meta_title',
        'meta_description',
        'tags',
        'description',
    ];
}
