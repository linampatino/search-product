<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description', 
        'score',
        'price',
        'category_id',
        'brand_id',
    ];

    public function category(){
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function brand(){
        return $this->hasOne('App\Brand', 'id', 'brand_id');
    }
}

