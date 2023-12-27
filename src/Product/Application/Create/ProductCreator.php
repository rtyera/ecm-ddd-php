<?php

declare(strict_types=1);

namespace TyCode\Product\Application\Create;

use TyCode\Product\Domain\Product\Product;
use TyCode\Product\Domain\Product\ProductId;
use TyCode\Product\Domain\Product\ProductImages;
use TyCode\Product\Domain\Product\ProductName;
use TyCode\Product\Domain\Product\ProductPrice;
use TyCode\Product\Domain\Product\ProductRepository;
use TyCode\Product\Domain\Product\ProductStockQuantity;

final class ProductCreator
{
    public function __construct(private readonly ProductRepository $repository)
    {
    }

    public function __invoke(ProductId $id, ProductName $name, ProductPrice $price, ProductImages $productImages, ProductStockQuantity $stockQuantity): void
    {
        $product = Product::create($id, $name, $price, $productImages, $stockQuantity);

        $this->repository->save($product);
    }
}
