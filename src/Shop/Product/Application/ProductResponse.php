<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application;

use TyCode\Shop\Product\Domain\Product;
use TyCode\Shared\Domain\Bus\Query\Response;

final class ProductResponse implements Response
{

    public function __construct(private readonly Product $product){}

    public function product(): Product
    {
        return $this->product;
    }
}
