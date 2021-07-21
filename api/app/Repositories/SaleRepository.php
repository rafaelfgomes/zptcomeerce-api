<?php

namespace App\Repositories;

use Error;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

class SaleRepository
{
  /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Sale::withTrashed()->get();
    }

    public function getOne(Sale $sale): Sale
    {
        return Sale::find($sale->id);
    }

    public function store(array $data): Sale
    {
        try {
            $data['uuid'] = Uuid::uuid4();
            $data['amount'] = doubleval(str_replace(',', '.', $data['amount']));

            $saleCreated = Sale::create($data);
        } catch (\Exception $e) {
            throw new Error($e->getMessage());
        }
        
        return $saleCreated;
    }
}