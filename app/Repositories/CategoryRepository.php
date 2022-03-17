<?php

namespace App\Repositories;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

     /**
     * Display a listing of the resource.
     *
     * @return Collection
      */
    public function getAll(): Collection
    {
        return Category::all();
    }

    /**
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * @param array $data
     * @return void
     */
    public function attachToCategory(array $data)
    {
        $product = $this->productRepository->findById($data['product_id']);
        $product->categories()->attach($data['category_id']);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        $category = Category::find($id);
        $category->delete();
        return $category;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function findById(int $id): Category
    {
        return Category::findOrFail($id);
    }
}
