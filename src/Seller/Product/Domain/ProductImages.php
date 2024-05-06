<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Domain;

use InvalidArgumentException;

final class ProductImages
{
    function __construct(private readonly array $value)
    {
        $this->ensureIsValidImages($value);
    }

    public function value(): array
    {
        return $this->value;
    }

    private function ensureIsValidImages(array $value): void
    {
        if (count($value) > 3) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow more of three images.', static::class));
        }
    }
}
