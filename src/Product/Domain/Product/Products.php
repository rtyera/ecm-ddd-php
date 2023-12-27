<?php

declare(strict_types=1);

namespace TyCode\Product\Domain\Product;

use TyCode\Product\Domain\Product\Product;
use TyCode\Shared\Domain\Collection;

final class Products extends Collection
{
    protected function type(): string
    {
        return Product::class;
    }
}
