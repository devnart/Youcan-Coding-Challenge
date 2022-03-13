<?php 

namespace App\Repositories;
use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::all();
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function attachToCategory(array $data)
    {
        $product = Product::findOrFail($data['product_id']);
        $product->categories()->attach($data['category_id']);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return $category;
    }
}