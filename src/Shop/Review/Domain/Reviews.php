<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Domain;

use TyCode\Shared\Domain\Collection;

final class Reviews extends Collection
{
    protected function type(): string
    {
        return Review::class;
    }
}
