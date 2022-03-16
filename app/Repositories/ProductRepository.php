<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use phpDocumentor\Reflection\Types\Collection;

class ProductRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return Product::paginate(10);
    }

    /**
     * @param string $by
     * @param int $categoryId
     * @return LengthAwarePaginator
     */
    public function sort(string $by, int $categoryId): LengthAwarePaginator
    {

        if ($categoryId) {
            $category = Category::findOrFail($categoryId);
            return $category->products()->orderBy($by)->paginate(10);

        } else {
            return Product::orderBy($by, 'asc')->paginate(10);
        }
    }

    /**
     * @param array $data
     * @param string $imageName
     * @return Product
     */
    public function create(array $data, string $imageName): Product
    {
        $product = new Product();

        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->image = $imageName;

        $product->save();

        return $product;
    }

    /**
     * @param array $data
     * @return void
     */
    public function attachToCategory(array $data)
    {
        $product = Product::findOrFail($data['product_id']);
        $product->categories()->attach($data['category_id']);
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getByCategory($id): Collection
    {
        $category = Category::findOrFail($id);
        return $category->products()->paginate(10);
    }

    /**
     * @param int $id
     * @return Product
     */
    public function findById(int $id): Product
    {
        return Product::findOrFail($id);
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
