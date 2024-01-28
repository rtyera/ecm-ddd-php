<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application\FindAll;

use Exception;
use TyCode\Seller\Product\Domain\ProductRepository;
use TyCode\Seller\Product\Domain\Products;

final class ProductFinderAll
{
    public function __construct(private readonly ProductRepository $repository)
    {
    }

    public function __invoke(): ?Products
    {
        $products = $this->repository->searchAll();

        return $products;
    }
}
