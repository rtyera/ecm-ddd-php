<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application\FindAll;

use TyCode\Seller\Product\Application\FindAll\ProductFinderAll;
use TyCode\Seller\Product\Application\ProductsResponse;
use TyCode\Shared\Domain\Bus\Query\QueryHandler;

final class FindProductsQueryHandler implements QueryHandler
{
    public function __construct(private readonly ProductFinderAll $finder)
    {
    }

    public function __invoke(FindProductsQuery $query): ?ProductsResponse
    {

        $products = $this->finder->__invoke();

        if(!$products){
            return null;
        }

        return new ProductsResponse($products);
    }

}
