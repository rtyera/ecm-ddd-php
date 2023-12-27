<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Infrastructure\Web\Product;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Shop\Product\Application\CQRS\Create\CreateProductCommand;
use TyCode\Shared\Domain\Bus\Command\CommandBus;

final class PostProductCreateCQRS
{

    public function __invoke(Request $request, CommandBus $commandBus): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);
        $createProductCommand = new CreateProductCommand(
            $parameters['id'],
            $parameters['name'],
            (float)$parameters['price'],
            (array)$parameters['images'],
            (int)$parameters['stockQuantity']
        );

        $commandBus->dispatch($createProductCommand);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
