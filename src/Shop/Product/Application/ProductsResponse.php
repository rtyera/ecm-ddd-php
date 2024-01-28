<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application;

use TyCode\Shop\Product\Domain\Products;
use TyCode\Shared\Domain\Bus\Query\Response;

final class ProductsResponse implements Response
{

    public function __construct(private readonly Products $products)
    {
    }

    public function products(): Products
    {
        return $this->products;
    }
}
