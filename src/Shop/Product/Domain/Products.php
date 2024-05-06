<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Domain;

use TyCode\Shop\Product\Domain\Product;
use TyCode\Shared\Domain\Collection;

final class Products extends Collection
{
    protected function type(): string
    {
        return Product::class;
    }
}
