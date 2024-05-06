<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Infrastructure\Web;

use TyCode\Seller\Product\Domain\Products;
use TyCode\Seller\Product\Domain\Product;

use function Lambdish\Phunctional\map;

final class ProductResponseMapper
{
    public static function productsToArray(?Products $products): array
    {
        if(!$products){
            return [];
        }

        return map(
            fn(Product $product) => $product->toPrimitives(),
            $products
        );
    }
}
