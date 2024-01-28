<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Infrastructure\Web;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Shop\Product\Application\ProductsResponse;
use TyCode\Shared\Domain\Bus\Query\QueryBus;
use TyCode\Shop\Product\Application\FindAll\FindProductsQuery;

final class GetProducts
{
    public function __invoke(Request $request, QueryBus $queryBus): JsonResponse
    {
        /** @var ProductsResponse $response */
        $response = $queryBus->ask(new FindProductsQuery());

        return new JsonResponse([
                'data' => ProductResponseMapper::productsToArray($response->products())
            ],
            Response::HTTP_OK
        );
    }

}
