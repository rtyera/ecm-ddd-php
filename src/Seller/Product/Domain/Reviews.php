<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Domain;
use TyCode\Shared\Domain\Collection;

final class Reviews extends Collection
{
    public function type(): string {
        return Review::class;
    }
}
