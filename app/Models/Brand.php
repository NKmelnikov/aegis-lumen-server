<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'active', 'position', 'slug', 'name', 'description', 'imgPath'
    ];
}
