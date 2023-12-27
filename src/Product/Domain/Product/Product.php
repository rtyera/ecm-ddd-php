<?php

declare(strict_types=1);

namespace TyCode\Product\Domain\Product;

use TyCode\Shared\Domain\Aggregate\AggregateRoot;

final class Product extends AggregateRoot
{
    public function __construct(private readonly ProductId $id,
                                private readonly ProductName $name,
                                private readonly ProductPrice $price,
                                private readonly ProductImages $images,
                                private readonly ProductStockQuantity $stockQuantity)
    {
    }

    public static function create(
        ProductId $id,
        ProductName $name,
        ProductPrice $price,
        ProductImages $images,
        ProductStockQuantity $stockQuantity): self
    {
        $product = new self($id, $name, $price, $images, $stockQuantity);

        return $product;
    }

    public function id(): string
    {
        return $this->id->value();
    }

    public function name(): string
    {
        return $this->name->value();
    }

    public function price(): float
    {
        return $this->price->value();
    }

    public function images(): array
    {
        return $this->images->value();
    }

    public function stockQuantity(): int
    {
        return $this->stockQuantity->value();
    }

    public function isAvailable() : bool
    {
        return true;
    }

    public static function fromPrimitives(array $primitives): Product
    {
        return new self(new ProductId($primitives['id']),
                        new ProductName($primitives['name']),
                        new ProductPrice($primitives['price']),
                        new ProductImages($primitives['images']),
                        new ProductStockQuantity($primitives['stockQuantity']));
    }

    public function toPrimitives(): array
    {
        return [
            'id'            => $this->id->value(),
            'name'          => $this->name->value(),
            'price'         => $this->price->value(),
            'images'        => $this->images->value(),
            'stockQuantity' => $this->stockQuantity->value()
        ];
    }
}
