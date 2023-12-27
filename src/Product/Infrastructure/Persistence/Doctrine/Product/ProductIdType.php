<?php

declare(strict_types=1);

namespace TyCode\Product\Infrastructure\Persistence\Doctrine\Product;

use TyCode\Product\Domain\Product\ProductId;
use TyCode\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class ProductIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return ProductId::class;
    }
}
