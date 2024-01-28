<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application\FindByCriteria;

use TyCode\Shop\Product\Domain\ProductRepository;
use TyCode\Shop\Product\Domain\Products;
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
