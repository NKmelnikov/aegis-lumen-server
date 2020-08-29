<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsDrill extends Model
{
    protected $table = 'products_drill';

    protected $fillable = [
        'brand_id',
        'category_id',
        'subcategory_id',
        'active',
        'position',
        'name',
        'description',
        'pdfPath',
    ];

    public function subcategory(){
        return $this->belongsTo('App\Models\Subcategory', 'subcategory_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
}
