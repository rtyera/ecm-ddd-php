<?php

declare(strict_types=1);

namespace TyCode\Product\Infrastructure\Web;

use TyCode\Product\Domain\Product\Products;
use TyCode\Product\Domain\Product\Product;

use function Lambdish\Phunctional\map;

final class ProductResponse
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
