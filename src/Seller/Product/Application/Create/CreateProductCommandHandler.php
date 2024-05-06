<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application\Create;

use TyCode\Seller\Product\Application\Create\ProductCreator;
use TyCode\Seller\Product\Domain\ProductId;
use TyCode\Seller\Product\Domain\ProductImages;
use TyCode\Seller\Product\Domain\ProductName;
use TyCode\Seller\Product\Domain\ProductPrice;
use TyCode\Seller\Product\Domain\ProductStockQuantity;
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
