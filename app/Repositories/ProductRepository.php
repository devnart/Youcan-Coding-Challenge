<?php

namespace App\Repositories;
use App\Models\Product;
use App\Models\Category;

class ProductRepository
{
    public function getAll()
    {
        return Product::all();
    }
    
    public function create(array $data, $imageName)
    {
        $product = new Product();

        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->image = $imageName;

        $product->save();

        return $product;
    }
}