<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Domain;

use TyCode\Seller\Product\Domain\Product;
use TyCode\Shared\Domain\Collection;

final class Products extends Collection
{
    protected function type(): string
    {
        return Product::class;
    }
}
