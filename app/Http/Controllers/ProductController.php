<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $request->query('sort') ? $this->productService->sort($request->query('sort'),$request->query('category')) : $this->productService->getAll();
    }

    /**
     * @param int $id
     * @return LengthAwarePaginator
     */
    public function getByCategory(int $id): LengthAwarePaginator
    {
        return $this->productService->getByCategory($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $this->productService->create($request->all());
            return response()->json('Product created successfully',201);
        }catch (ValidationException $ex){
            return response()->json($ex->errors(), $ex->status);
        }
    }

}
