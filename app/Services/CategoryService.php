<?php

namespace App\Services;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;

class CategoryService
{

    /**
     * The Category repository implementation.
     * @var CategoryRepository
     */

    private $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param  CategoryRepository  $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * @param int $id
     * @return Category
     */
    public function findById(int $id): Category
    {
        return $this->categoryRepository->findById($id);
    }


    /**
     * @param array $data
     * @return void
     * @throws ValidationException
     */
    public function attachToCategory(array $data)
    {
        $validator = Validator::make($data, [
            'product_id' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $this->categoryRepository->attachToCategory($data);

    }

    /**
     * @param array
     * @return void
     * @throws ValidationException
     */
    public function create(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'parent_id' => 'numeric|nullable'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $this->categoryRepository->create($data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->categoryRepository->delete($id);
    }

}
