<?php

declare(strict_types=1);

namespace TyCode\Product\Application\Find;

use TyCode\Product\Domain\Product\ProductRepository;
use TyCode\Product\Domain\Product\Products;
use TyCode\Shared\Domain\Criteria\Criteria;

final class ProductFinderByCriteria
{
    public function __construct(private readonly ProductRepository $repository)
    {
    }

    public function __invoke(Criteria $criteria): ?Products
    {
        $products = $this->repository->matching($criteria);

        return $products;
    }
}
