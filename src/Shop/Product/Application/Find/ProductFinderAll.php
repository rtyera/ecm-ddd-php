<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application\Find;

use Exception;
use TyCode\Shop\Product\Domain\ProductRepository;
use TyCode\Shop\Product\Domain\Products;

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
