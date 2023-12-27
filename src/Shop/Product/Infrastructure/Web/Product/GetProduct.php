<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Infrastructure\Web\Product;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TyCode\Shop\Product\Application\Find\ProductFinderId;
use TyCode\Shop\Product\Domain\ProductId;

final class GetProduct
{
    public function __invoke(Request $request, ProductFinderId $productFinderId): JsonResponse
    {
        $id = new ProductId($request->get('id'));
        $product = $productFinderId->__invoke($id);

        return new JsonResponse([
                'data' => $product->toPrimitives()
            ],
            Response::HTTP_OK
        );
    }
}
