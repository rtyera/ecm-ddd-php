<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Infrastructure\Web;

use TyCode\Shop\Product\Domain\Products;
use TyCode\Shop\Product\Domain\Product;

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
