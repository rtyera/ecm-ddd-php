<?php

declare(strict_types=1);

namespace TyCode\Product\Infrastructure\Web\Product;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Product\Application\Find\ProductFinderAll;
use TyCode\Product\Infrastructure\Web\ProductResponse;

final class GetProducts
{
    public function __invoke(Request $request, ProductFinderAll $productFinderAll): JsonResponse
    {
        $products = $productFinderAll->__invoke();

        return new JsonResponse([
                'data' => ProductResponse::productsToArray($products)
            ],
            Response::HTTP_OK
        );
    }

}
