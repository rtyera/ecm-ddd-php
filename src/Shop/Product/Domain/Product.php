<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Domain;

use TyCode\Shared\Domain\Aggregate\AggregateRoot;

final class Product extends AggregateRoot
{
    public function __construct(private readonly ProductId $id,
                                private readonly ProductName $name,
                                private readonly ProductPrice $price,
                                private readonly ProductImages $images,
                                private readonly ProductStockQuantity $stockQuantity,
                                private readonly ProductRating $rating,
                                private readonly ProductReviews $reviews)
    {
    }

    public static function create(
        ProductId $id,
        ProductName $name,
        ProductPrice $price,
        ProductImages $images,
        ProductStockQuantity $stockQuantity,
        ProductRating $rating,
        ProductReviews $reviews): self
    {
        $product = new self($id, $name, $price, $images, $stockQuantity, $rating, $reviews);

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
    public function rating(): int
    {
        return $this->rating->value();
    }

    public function reviews(): array
    {
        return $this->reviews->value();
    }

    public function toPrimitives(): array
    {
        return [
            'id'            => $this->id->value(),
            'name'          => $this->name->value(),
            'price'         => $this->price->value(),
            'images'        => $this->images->value(),
            'stockQuantity' => $this->stockQuantity->value(),
            'rating'        => $this->rating->value(),
            'reviews'       => $this->reviews->value()
        ];
    }
}
