<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application\CQRS\Create;

use TyCode\Shared\Domain\Bus\Command\Command;

final class CreateProductCommand implements Command
{
    public function __construct(private readonly string $id,
                                private readonly string $name,
                                private readonly float $price,
                                private readonly array $images,
                                private readonly int $stockQuantity)
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function images(): array
    {
        return $this->images;
    }

    public function stockQuantity(): int
    {
        return $this->stockQuantity;
    }
}
