<?php

declare(strict_types=1);

namespace TyCode\Product\Application\CQRS\FindByCriteria;

use TyCode\Shared\Domain\Bus\Query\Query;
use TyCode\Shared\Domain\Criteria\Criteria;

final class FindProductByCriteriaQuery implements Query
{
    public function __construct(private readonly Criteria $criteria){}

    public function criteria(): Criteria
    {
        return $this->criteria;
    }

}
