<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Get the categories of the product.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','categories_products');
    }
}
