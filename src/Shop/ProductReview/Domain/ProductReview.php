<?php

declare(strict_types=1);

namespace TyCode\Shop\ProductReview\Domain;

use TyCode\Shared\Domain\Aggregate\AggregateRoot;

final class ProductReview extends AggregateRoot
{
    public function __construct()
    {
    }

    public static function create(
        ): self
    {
        return new self();
    }

}
