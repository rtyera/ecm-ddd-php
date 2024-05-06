<?php

declare(strict_types=1);

namespace TyCode\ms\Seller\Controller\Product;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Seller\Product\Application\FindAll\FindProductsQuery;
use TyCode\Seller\Product\Application\ProductsResponse;
use TyCode\Seller\Product\Infrastructure\Web\ProductResponseMapper;
use TyCode\Shared\Domain\Bus\Query\QueryBus;

final class GetProducts
{
    public function __invoke(Request $request, QueryBus $queryBus): JsonResponse
    {
        /** @var ProductsResponse $response */
        $response = $queryBus->ask(new FindProductsQuery());

        return new JsonResponse([
                'data' => isset($response) ? ProductResponseMapper::productsToArray($response->products()) : []
            ],
            Response::HTTP_OK
        );
    }

}
