<?php

declare(strict_types=1);

namespace TyCode\Product\Infrastructure\Web\Product;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Product\Application\Create\ProductCreator;
use TyCode\Product\Domain\Product\ProductId;
use TyCode\Product\Domain\Product\ProductImages;
use TyCode\Product\Domain\Product\ProductName;
use TyCode\Product\Domain\Product\ProductPrice;
use TyCode\Product\Domain\Product\ProductStockQuantity;

final class PostProductCreate
{

    public function __invoke(Request $request, ProductCreator $productCreator): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);

        $productCreator->__invoke(
            new ProductId($parameters['id']),
            new ProductName($parameters['name']),
            new ProductPrice((float)$parameters['price']),
            new ProductImages((array)$parameters['images']),
            new ProductStockQuantity((int)$parameters['stockQuantity'])
        );

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
