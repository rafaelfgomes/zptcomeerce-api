<?php

namespace App\Repositories;

use Error;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Product::withTrashed()->get();
    }

    public function getActives(): Collection
    {
        return Product::all();
    }

    public function store(array $data): Product
    {
        try {
            //$imagePath = Storage::putFile('public/images', $data['image']);
            $fileName = Str::random(32) . '.' . $data['image']->getClientOriginalExtension();

            $imagePath = $data['image']->move('images', $fileName)->getPathName();
            unset($data['image']);

            $data['image_path'] = $imagePath;

            $productCreated = Product::create($data);
        } catch (\Exception $e) {
            throw new Error($e->getMessage());
        }
        
        return $productCreated;
    }

    public function update(array $data, Product $product): Product
    {
        $productUpdated = tap($product)->update($data);

        return $productUpdated;
    }

    public function delete(Product $product): Product
    {
        $productInactive = tap($product)->delete();

        return $productInactive;
    }
}