<?php

declare(strict_types=1);

namespace TyCode\Product\Application\CQRS\FindByCriteria;

use TyCode\Product\Application\Find\ProductFinderByCriteria;
use TyCode\Shared\Domain\Bus\Query\QueryHandler;

final class FindProductByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private readonly ProductFinderByCriteria $finder)
    {
    }

    public function __invoke(FindProductByCriteriaQuery $query): ?ProductsResponse
    {

        $products = $this->finder->__invoke($query->criteria());

        if(!$products){
            return null;
        }

        return new ProductsResponse($products);
    }

}
