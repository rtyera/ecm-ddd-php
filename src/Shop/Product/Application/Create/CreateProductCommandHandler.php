<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application\Create;

use TyCode\Shop\Product\Application\Create\ProductCreator;
use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shop\Product\Domain\ProductImages;
use TyCode\Shop\Product\Domain\ProductName;
use TyCode\Shop\Product\Domain\ProductPrice;
use TyCode\Shop\Product\Domain\ProductRating;
use TyCode\Shop\Product\Domain\ProductStockQuantity;
use TyCode\Shared\Domain\Bus\Command\CommandHandler;
use TyCode\Shop\Product\Domain\ProductReviews;

final class CreateProductCommandHandler implements CommandHandler
{
    public function __construct(private readonly ProductCreator $productCreator)
    {
    }

    public function __invoke(CreateProductCommand $command): void
    {
        $id             = new ProductId($command->id());
        $name           = new ProductName($command->name());
        $price          = new ProductPrice($command->price());
        $images         = new ProductImages($command->images());
        $stockQuantity  = new ProductStockQuantity($command->stockQuantity());

        $this->productCreator->__invoke($id, $name, $price, $images, $stockQuantity);
    }
}
