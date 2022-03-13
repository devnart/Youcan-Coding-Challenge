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

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return $category;
    }
}