<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name', 'description', 'active', 'category_id', 'subcategory_id', 'tech_description_path', 'tech_passport_path'
    ];

    public function subcategory(){
        return $this->belongsTo('App\Subcategory', 'subcategory_id');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}
