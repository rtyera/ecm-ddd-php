<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Infrastructure\Persistence\Doctrine;

use TyCode\Shared\Infrastructure\Persistence\Doctrine\UuidType;
use TyCode\Shop\Review\Domain\ReviewId;

final class ReviewIdType extends UuidType
{
    protected function typeClassName(): string
    {
        return ReviewId::class;
    }
}
