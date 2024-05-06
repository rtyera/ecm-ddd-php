<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application\FindById;

use TyCode\Shop\Product\Application\ProductResponse;
use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shared\Domain\Bus\Query\QueryHandler;

final class FindProductQueryHandler implements QueryHandler
{
    public function __construct(private readonly ProductFinderId $finder)
    {
    }

    public function __invoke(FindProductQuery $query): ?ProductResponse
    {
        $productId = new ProductId($query->id());

        $product = $this->finder->__invoke($productId);

        if(!$product){
            return null;
        }

        return new ProductResponse($product);
    }

}
