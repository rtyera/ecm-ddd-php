<?php

declare(strict_types=1);

namespace TyCode\Seller\Review\Domain;

use DateTime;
use TyCode\Shared\Domain\ValueObject\DateValueObject;

final class ReviewCreateOn extends DateValueObject
{
    public static function now(): self
    {
        return new self(new DateTime());
    }
}
