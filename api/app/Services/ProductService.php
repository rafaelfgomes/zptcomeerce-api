<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\ProductRelations;

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

    public function getOne(Product $product): ProductRelations
    {
        $product = new ProductRelations($this->productRepository->getOne($product));

        return $product;
    }

    public function store(array $data): ProductRelations
    {
        $productCreated = new ProductRelations($this->productRepository->store($data));

        return $productCreated;
    }

    public function update(array $data, Product $product): ProductRelations
    {
        $productUpdated = new ProductRelations($this->productRepository->update($data, $product));

        return $productUpdated;
    }

    public function search(string $productName): ProductCollection
    {
        $productsFound = new ProductCollection($this->productRepository->search($productName));

        return $productsFound;
    }

    public function delete(Product $product): ProductRelations
    {
        $productDeleted = new ProductRelations($this->productRepository->delete($product));

        return $productDeleted;
    }
}