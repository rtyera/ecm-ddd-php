<?php

declare(strict_types=1);

namespace TyCode\Shared\Domain\ValueObject;

interface JsonInterface
{
    public function toPrimitives(): array;

    public static function fromPrimitives(array $primitives): mixed;
}