<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Infrastructure\Web\Product;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Shop\Product\Application\Create\ProductCreator;
use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shop\Product\Domain\ProductImages;
use TyCode\Shop\Product\Domain\ProductName;
use TyCode\Shop\Product\Domain\ProductPrice;
use TyCode\Shop\Product\Domain\ProductRating;
use TyCode\Shop\Product\Domain\ProductReviews;
use TyCode\Shop\Product\Domain\ProductStockQuantity;

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
            new ProductStockQuantity((int)$parameters['stockQuantity']),
            new ProductRating(array_key_exists('rating', $parameters) ? (int)$parameters['rating'] : null),
            ProductReviews::fromPrimitives(array_key_exists('reviews', $parameters) ? (array)$parameters['reviews'] : null)
        );

        return new JsonResponse(null, Response::HTTP_CREATED);
    }

}
