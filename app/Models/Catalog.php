<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable = [
        'active','category_id','brand_id','name','path'
    ];

    public function brand(){
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}
