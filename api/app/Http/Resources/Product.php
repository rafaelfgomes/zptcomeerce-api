<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class Product extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'image' => env('APP_URL') . '/' . $this->image_path,
            'price' => 'R$ ' . number_format($this->price, 2, ',', '.'),
            'quantity' => $this->quantity,
            'active' => (empty($this->deleted_at)) ? true : false
        ];

        return $data;
    }
}
