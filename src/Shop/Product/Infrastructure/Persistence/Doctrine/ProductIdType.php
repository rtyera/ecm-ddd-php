<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Infrastructure\Persistence\Doctrine;

use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class ProductIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return ProductId::class;
    }
}
