<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Infrastructure\Web;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Shared\Domain\Bus\Command\CommandBus;
use TyCode\Shop\Review\Application\Checker\CheckerReviewCommand;

final class PutCheckerReview
{
    public function __invoke(Request $request, CommandBus $commandBus): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);

        $checkerReviewCommand = new CheckerReviewCommand(
            $request->get('product_id'),
            (bool)$parameters['deliver']
        );

        $commandBus->dispatch($checkerReviewCommand);

        return new JsonResponse(null, Response::HTTP_OK);
    }
}
