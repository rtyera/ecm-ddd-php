<?php

declare(strict_types=1);

namespace TyCode\Product\Application\Find;

use Exception;
use TyCode\Product\Domain\Product\ProductRepository;
use TyCode\Product\Domain\Product\Products;

final class ProductFinderAll
{
    public function __construct(private readonly ProductRepository $repository)
    {
    }

    public function __invoke(): Products
    {
        $products = $this->repository->searchAll();

        if($products === null){
            throw new Exception("Product is empty");
        }

        return $products;
    }
}
