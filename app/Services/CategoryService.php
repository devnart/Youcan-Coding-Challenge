<?php 

namespace App\Services;
use App\Repositories\CategoryRepository;

class CategoryService
{

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function create(array $data)
    {
        $this->categoryRepository->create($data);
        return response()->json(['success' => 'Category has been created successfully.']);
    }
}