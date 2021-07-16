<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Product::all();
    }
}