<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metalworking extends Model
{
    protected $table = 'metalworking';

    protected $fillable = [
        'active', 'position', 'name', 'description', 'imgPath'
    ];
}
