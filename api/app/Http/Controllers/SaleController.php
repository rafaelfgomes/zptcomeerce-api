<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Traits\ApiResponser;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SaleStoreRequest;

class SaleController extends Controller
{
    use ApiResponser;

    protected $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    public function all(): JsonResponse
    {
        return $this->successResponse($this->saleService->all());
    }

    public function getOne(Sale $sale): JsonResponse
    {
        return $this->successResponse($this->saleService->getOne($sale));
    }

    public function store(SaleStoreRequest $request): JsonResponse
    {
        return $this->successResponse($this->saleService->store($request->all()));
    }
}
