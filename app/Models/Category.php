<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','parent_id'];

    /**
     * Get the products of the category.
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Product','categories_products');
    }
}
