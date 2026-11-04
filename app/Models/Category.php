<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
// use App\Models\Category;

class Category extends Model
{
    protected $fillable = ["name","slug","icon", "sort_order"];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
