<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Infrastructure\Persistence\Doctrine;

use TyCode\Seller\Product\Domain\ProductId;
use TyCode\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class ProductIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return ProductId::class;
    }
}
