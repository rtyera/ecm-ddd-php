<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application\Create;

use TyCode\Seller\Product\Domain\Product;
use TyCode\Seller\Product\Domain\ProductId;
use TyCode\Seller\Product\Domain\ProductImages;
use TyCode\Seller\Product\Domain\ProductName;
use TyCode\Seller\Product\Domain\ProductPrice;
use TyCode\Seller\Product\Domain\ProductRepository;
use TyCode\Seller\Product\Domain\ProductStockQuantity;

final class ProductCreator
{
    public function __construct(private readonly ProductRepository $repository)
    {
    }

    public function __invoke(ProductId $id,
                            ProductName $name,
                            ProductPrice $price,
                            ProductImages $productImages,
                            ProductStockQuantity $stockQuantity): void
    {
        $product = Product::create($id, $name, $price, $productImages, $stockQuantity);

        $this->repository->save($product);
    }
}
