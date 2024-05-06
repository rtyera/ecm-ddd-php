<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application\Create;

use TyCode\Shared\Domain\Bus\Event\EventBus;
use TyCode\Shop\Product\Domain\Product;
use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shop\Product\Domain\ProductImages;
use TyCode\Shop\Product\Domain\ProductName;
use TyCode\Shop\Product\Domain\ProductPrice;
use TyCode\Shop\Product\Domain\ProductRepository;
use TyCode\Shop\Product\Domain\ProductStockQuantity;

final class ProductCreator
{
    public function __construct(private readonly ProductRepository $repository, private readonly EventBus $eventBus)
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
        $this->eventBus->publish(...$product->pullEvents());
    }
}
