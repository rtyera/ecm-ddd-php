<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application\FindById;

use TyCode\Seller\Product\Application\FindById\ProductFinderId;
use TyCode\Seller\Product\Application\ProductResponse;
use TyCode\Seller\Product\Domain\ProductId;
use TyCode\Shared\Domain\Bus\Query\QueryHandler;

final class FindProductQueryHandler implements QueryHandler
{
    public function __construct(private readonly ProductFinderId $finder)
    {
    }

    public function __invoke(FindProductQuery $query): ?ProductResponse
    {

        $product = $this->finder->__invoke(new ProductId($query->id()));

        if(!$product){
            return null;
        }

        return new ProductResponse($product);
    }

}
