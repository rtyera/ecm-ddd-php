<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Domain;

use InvalidArgumentException;

final class ProductPrice
{
    function __construct(private readonly float $value)
    {
        $this->ensureIsValidPrice($value);
    }

    public function value(): float
    {
        return $this->value;
    }

    private function ensureIsValidPrice(float $value): void
    {
        if (!($value > 0)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $value));
        }
    }
}
