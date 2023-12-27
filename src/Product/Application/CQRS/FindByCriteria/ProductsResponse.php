<?php

declare(strict_types=1);

namespace TyCode\Product\Application\CQRS\FindByCriteria;

use TyCode\Product\Domain\Product\Products;
use TyCode\Shared\Domain\Bus\Query\Response;

final class ProductsResponse implements Response
{

    public function __construct(private Products $products)
    {
        $this->products = $products;
    }

    public function products(): Products
    {
        return $this->products;
    }
}
