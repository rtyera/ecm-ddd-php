<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Domain;

use TyCode\Shared\Domain\Aggregate\AggregateRoot;
use TyCode\Shop\Product\Domain\Event\CreatedProductEvent;

final class Product extends AggregateRoot
{
    public function __construct(private readonly ProductId $id,
                                private readonly ProductName $name,
                                private readonly ProductPrice $price,
                                private readonly ProductImages $images,
                                private readonly ProductStockQuantity $stockQuantity/*,
                                private readonly ?ProductRating $rating = null,
                                private readonly ?ProductReviews $reviews = null*/)
    {
    }

    public static function create(
        ProductId $id,
        ProductName $name,
        ProductPrice $price,
        ProductImages $images,
        ProductStockQuantity $stockQuantity/*,
        ProductRating $rating,
        ProductReviews $reviews*/): self
    {
        $product = new self($id, $name, $price, $images, $stockQuantity);

        $product->record(new CreatedProductEvent(
            $id->value(),
            $name->value(),
            $price->value(),
            $images->value(),
            $stockQuantity->value()
        ));

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
    // public function rating(): ?int
    // {
    //     return $this->rating->value();
    // }

    // public function reviews(): ?array
    // {
    //     return $this->reviews->value();
    // }

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
