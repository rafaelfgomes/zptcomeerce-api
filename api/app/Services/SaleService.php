<?php

namespace App\Services;

use App\Models\Sale;
use App\Repositories\SaleRepository;
use App\Http\Resources\Sales\SaleCollection;
use App\Http\Resources\Sales\SaleRelations;

class SaleService
{
  protected $saleRepository;

  public function __construct(SaleRepository $saleRepository)
  {
    $this->saleRepository = $saleRepository;
  }

  public function all(): SaleCollection
  {
    $sales = new SaleCollection($this->saleRepository->all());
    
    return $sales;
  }

  public function getOne(Sale $sale): SaleRelations
  {
    $sale = new SaleRelations($this->saleRepository->getOne($sale));
      
    return $sale;
  }

  public function store(array $data): SaleRelations
  {
    $saleCreated = new SaleRelations($this->saleRepository->store($data));
    
    return $saleCreated;
  }
}