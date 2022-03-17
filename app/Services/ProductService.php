<?php

namespace App\Services;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductService
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
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->productRepository->getAll();
    }

    /**
     * @param string $by
     * @param int|null $category
     * @return LengthAwarePaginator
     */
    public function sort(string $by, int $category = null)
    {
        return $this->productRepository->sort($by, $category);
    }

    /**
     * @param array $data
     *
     * @throws ValidationException
     */
    public function create(array $data)
    {

        $validator = Validator::make($data, [
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $imageName = time().'-'.$data['name'].'.'.$data['image']->extension();
        $data['image']->move(public_path('images'), $imageName);

        $this->productRepository->create($data, $imageName);
    }

    /**
     * @param int $id
     * @return LengthAwarePaginator
     */
    public function getByCategory(int $id): LengthAwarePaginator
    {
        return $this->productRepository->getByCategory($id);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->productRepository->delete($id);
    }
}
