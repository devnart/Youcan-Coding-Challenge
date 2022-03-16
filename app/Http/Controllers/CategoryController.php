<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{

    /**
     * The user repository implementation.
     *
     * @var CategoryService
     */
    private $categoryService;


    /**
     * Create a new controller instance.
     *
     * @param  CategoryService  $categoryService
     * @return void
     */

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->categoryService->getAll();
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $this->categoryService->create($request->all());
            return response()->json('category created successfully',201);
        }catch (ValidationException $ex){
            return response()->json($ex->errors(), $ex->status);
        }

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function attachToCategory(Request $request): JsonResponse
    {
        try {
            $this->categoryService->attachToCategory($request->all());
            return response()->json('product attached successfully',201);
        }catch (ValidationException $ex){
            return response()->json($ex->errors(), $ex->status);
        }
    }
}
