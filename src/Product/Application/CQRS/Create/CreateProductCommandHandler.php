<?php

declare(strict_types=1);

namespace TyCode\Product\Application\CQRS\Create;

use TyCode\Product\Application\Create\ProductCreator;
use TyCode\Product\Domain\Product\ProductId;
use TyCode\Product\Domain\Product\ProductImages;
use TyCode\Product\Domain\Product\ProductName;
use TyCode\Product\Domain\Product\ProductPrice;
use TyCode\Product\Domain\Product\ProductStockQuantity;
use TyCode\Shared\Domain\Bus\Command\CommandHandler;

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
