<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Domain;

use InvalidArgumentException;

final class ProductRating
{
    function __construct(private readonly ?int $value)
    {
        $this->ensureIsValidRating($value);
    }

    public function value(): ?int
    {
        return $this->value;
    }

    private function ensureIsValidRating(?int $value): void
    {
        if ($value && ($value < 1) || ($value > 5)) {
            throw new InvalidArgumentException(sprintf('Rating value %s is invalid, it may between 1 and 5.', $value));
        }
    }
}
