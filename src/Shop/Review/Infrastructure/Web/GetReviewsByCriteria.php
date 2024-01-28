<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Infrastructure\Web;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Shared\Domain\Bus\Query\QueryBus;

final class GetReviewsByCriteria
{
    public function __invoke(Request $request, QueryBus $queryBus): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_OK);
    }

}
