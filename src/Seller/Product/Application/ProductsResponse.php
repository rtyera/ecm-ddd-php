<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application;

use TyCode\Seller\Product\Domain\Products;
use TyCode\Shared\Domain\Bus\Query\Response;

final class ProductsResponse implements Response
{

    public function __construct(private Products $products){}

    public function products(): Products
    {
        return $this->products;
    }
}
