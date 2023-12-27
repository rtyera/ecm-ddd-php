<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Infrastructure\Web\HealthCheck;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HealthCheckGetController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'healthCheck' => 'Ok',
            ]
        );
    }
}
