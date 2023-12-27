<?php

declare(strict_types=1);

namespace TyCode\Product\Infrastructure\Web\Product;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Product\Application\CQRS\FindByCriteria\FindProductByCriteriaQuery;
use TyCode\Product\Application\CQRS\FindByCriteria\ProductsResponse;
use TyCode\Product\Domain\Product\Product;
use TyCode\Product\Infrastructure\Web\ProductResponse;
use TyCode\Shared\Domain\Bus\Query\QueryBus;
use TyCode\Shared\Infrastructure\HttpQuery\QueryCriteriaConverter;

final class GetProductByCriteriaCQRS
{
    public function __invoke(Request $request, QueryBus $queryBus): JsonResponse
    {
        $criteriaConverter = new QueryCriteriaConverter(Product::class);
        $criteria = $criteriaConverter->convert($request->query);

        /** @var ProductsResponse $response */
        $response = $queryBus->ask(new FindProductByCriteriaQuery($criteria));

        return new JsonResponse([
                'data' => ProductResponse::productsToArray($response->products())
            ],
            Response::HTTP_OK
        );
    }

}
