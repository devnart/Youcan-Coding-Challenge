<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','parent_id'];

    /**
     * Get the products of the category.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product','categories_products');
    }
}
