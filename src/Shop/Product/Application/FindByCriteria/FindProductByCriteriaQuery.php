<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application\FindByCriteria;

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
