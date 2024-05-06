<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\FindByProductId;

use TyCode\Shared\Domain\Bus\Query\Query;


final class FindReviewByProductIdQuery implements Query
{
    public function __construct(private readonly string $productId){}

    public function productId(): string
    {
        return $this->productId;
    }

}
