<?php

declare(strict_types=1);

namespace TyCode\Product\Infrastructure\Web\Product;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Product\Application\Find\ProductFinderByCriteria;
use TyCode\Product\Domain\Product\Product;
use TyCode\Product\Infrastructure\Web\ProductResponse;
use TyCode\Shared\Infrastructure\HttpQuery\QueryCriteriaConverter;

final class GetProductByCriteria
{
    public function __invoke(Request $request, ProductFinderByCriteria $productFinderByCriteria): JsonResponse
    {
        $criteriaConverter = new QueryCriteriaConverter(Product::class);
        $criteria = $criteriaConverter->convert($request->query);

        $products = $productFinderByCriteria->__invoke($criteria);

        return new JsonResponse([
                'data' => ProductResponse::productsToArray($products)
            ],
            Response::HTTP_OK
        );
    }

}
