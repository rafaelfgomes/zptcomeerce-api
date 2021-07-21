<?php

namespace App\Http\Resources\Sales;

use App\Http\Resources\Products\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleRelations extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'quantity' => $this->quantity,
            'amount' => number_format($this->amount, 2, ',', '.'),
            'product' => new ProductResource($this->find($this->id)->product)
        ];

        return $data;
    }
}
