<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Infrastructure\Persistence\Doctrine;

use TyCode\Shared\Infrastructure\Persistence\Doctrine\JsonCustomType;
use TyCode\Seller\Product\Domain\ProductReviews;

final class ProductReviewsType extends JsonCustomType
{
    protected function typeClassName(): string
    {
        return ProductReviews::class;
    }
}
