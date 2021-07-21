<?php

namespace App\Http\Resources\Sales;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = [
            'uuid' => $this->uuid,
            'quantity' => $this->quantity,
            'amount' => number_format($this->amount, 2, ',', '.')
        ];

        return $data;
    }
}
