<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;
use App\Models\Product;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;    
    }

    public function all(): ProductCollection
    {
        $products = new ProductCollection($this->productRepository->all());

        return $products;
    }

    public function getActives(): ProductCollection
    {
        $productsActive = new ProductCollection($this->productRepository->getActives());

        return $productsActive;
    }

    public function getOne(Product $product): ProductResource
    {
        $product = new ProductResource($this->productRepository->getOne($product));

        return $product;
    }

    public function store(array $data): ProductResource
    {
        $productCreated = new ProductResource($this->productRepository->store($data));

        return $productCreated;
    }

    public function update(array $data, Product $product): ProductResource
    {
        $productUpdated = new ProductResource($this->productRepository->update($data, $product));

        return $productUpdated;
    }

    public function checkout(Product $product, int $quantity): ProductResource
    {
        $productBuyed = new ProductResource($this->productRepository->checkout($product, $quantity));

        return $productBuyed;
    }

    public function delete(Product $product): ProductResource
    {
        $productDeleted = new ProductResource($this->productRepository->delete($product));

        return $productDeleted;
    }
}