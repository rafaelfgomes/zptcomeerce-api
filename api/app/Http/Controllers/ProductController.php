<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    use ApiResponser;

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function all(): JsonResponse
    {
        return $this->successResponse($this->productService->all());
    }

    public function getActives(): JsonResponse
    {
        return $this->successResponse($this->productService->getActives());
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        return $this->successResponse($this->productService->store($request->all()), Response::HTTP_CREATED);
    }

    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        return $this->successResponse($this->productService->update($request->all(), $product));
    }

    public function delete(Product $product): JsonResponse
    {
        return $this->successResponse($this->productService->delete($product));
    }
}
