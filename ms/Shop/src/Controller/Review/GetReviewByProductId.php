<?php

declare(strict_types=1);

namespace TyCode\ms\Shop\Controller\Review;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Shared\Domain\Bus\Query\QueryBus;
use TyCode\Shop\Review\Application\FindByProductId\FindReviewByProductIdQuery;
use TyCode\Shop\Review\Application\ReviewsResponse;
use TyCode\Shop\Review\Infrastructure\Web\ReviewResponseMapper;

final class GetReviewByProductId
{
    public function __invoke(Request $request, QueryBus $queryBus): JsonResponse
    {
        /** @var ReviewsResponse $response */
        $response = $queryBus->ask(new FindReviewByProductIdQuery($request->get('product_id')));

        return new JsonResponse([
                'data' => ReviewResponseMapper::ReviewsToArray($response->reviews())
            ],
            Response::HTTP_OK
        );
    }
}
