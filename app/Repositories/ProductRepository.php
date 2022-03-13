<?php

namespace App\Repositories;
use App\Models\Product;
use App\Models\Category;

class ProductRepository
{
    public function getAll()
    {
        return Product::paginate(10);
    }

    public function sort($by, $categoryId)
    {

        if ($categoryId) {
            $category = Category::findOrFail($categoryId);

            $sorted = $category->products->sortBy($by);
            return $sorted->values()->all();
        } else {
            return Product::orderBy($by)->get();
        }
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

    public function attachToCategory(array $data)
    {
        $product = Product::findOrFail($data['product_id']);
        $product->categories()->attach($data['category_id']);
    }

    public function getByCategory($id)
    {
        $category = Category::findOrFail($id);
        return $category->products;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}