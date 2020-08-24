<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'slug', 'active', 'position', 'title', 'shortText', 'article', 'imgPath',
    ];
}
