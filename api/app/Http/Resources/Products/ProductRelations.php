<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Sales\SaleCollection;
use App\Http\Resources\Sales\SaleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductRelations extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'image' => env('APP_URL') . '/' . $this->image_path,
            'price' => number_format($this->price, 2, ',', '.'),
            'quantity' => $this->quantity,
            'active' => (empty($this->deleted_at)) ? true : false,
            'sales' => $this->find($this->id)->sales->map(function ($value) {
                return new SaleResource($value);
            })
        ];

        return $data;
    }
}
