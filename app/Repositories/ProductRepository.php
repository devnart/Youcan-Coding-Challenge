<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @param int|null $categoryId
     * @return LengthAwarePaginator
     */
    public function sort(string $by, int $categoryId = null): LengthAwarePaginator
    {

        if ($categoryId) {
            // $category = $this->categoryRepository->findById($categoryId);
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
     * @param int $id
     * @return LengthAwarePaginator
     */
    public function getByCategory(int $id): LengthAwarePaginator
    {
        // $category = $this->categoryRepository->findById($id);
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
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
