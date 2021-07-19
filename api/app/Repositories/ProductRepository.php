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
            $data['image_path'] = $this->saveImage($data);
            $data['price'] = doubleval(str_replace(',', '.', $data['price']));

            unset($data['image']);

            $productCreated = Product::create($data);
        } catch (\Exception $e) {
            throw new Error($e->getMessage());
        }
        
        return $productCreated;
    }

    public function update(array $data, Product $product): Product
    {
        try {
            if (array_key_exists('image', $data)) {
                if (!str_contains($data['image'], 'noimage')) {
                    unlink(public_path() . '/' . $product->image_path);
                }
                $data['image_path'] = $this->saveImage($data);
                unset($data['image']);
            }
    
            $data['price'] = doubleval(str_replace(',', '.', $data['price']));
            $data['deleted_at'] = (array_key_exists('active', $data)) ? $product->restore() : $product->delete();
    
            $productUpdated = tap($product)->update($data);
        } catch (\Exception $e) {
            throw new Error($e->getMessage());
        }
        
        return $productUpdated;
    }

    public function delete(Product $product): Product
    {
        $productInactive = tap($product)->delete();

        return $productInactive;
    }

    private function saveImage(array $data): string
    {
        $fileName = Str::random(32) . '.' . $data['image']->getClientOriginalExtension();

        return $data['image']->move('images', $fileName)->getPathName();
    }
}