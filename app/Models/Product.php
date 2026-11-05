<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'image', 'slug', 'name', 'short_description', 'description', 'price', 'price_art_cartoon', 'price_art_paper', 'price_hvs', 'price_doft', 'price_glossy', 'price_cutting'];

    //many to one relationship with Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //hasMany Image
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
