<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Infrastructure\Web;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Shop\Product\Application\FindByCriteria\FindProductByCriteriaQuery;
use TyCode\Shop\Product\Domain\Product;
use TyCode\Shared\Domain\Bus\Query\QueryBus;
use TyCode\Shared\Infrastructure\HttpQuery\QueryCriteriaConverter;
use TyCode\Shop\Product\Application\ProductsResponse;

final class GetProductByCriteria
{
    public function __invoke(Request $request, QueryBus $queryBus): JsonResponse
    {
        $criteriaConverter = new QueryCriteriaConverter(Product::class);
        $criteria = $criteriaConverter->convert($request->query);

        /** @var ProductsResponse $response */
        $response = $queryBus->ask(new FindProductByCriteriaQuery($criteria));

        return new JsonResponse([
                'data' => isset($response) ? ProductResponseMapper::productsToArray($response->products()) : []
            ],
            Response::HTTP_OK
        );
    }

}
