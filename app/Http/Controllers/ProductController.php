<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function getByCategory($id){
        return $this->productService->getByCategory($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->productService->create($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        return $this->productService->delete($product->id);
    }
}
