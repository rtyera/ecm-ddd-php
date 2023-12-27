<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\Doctrine\Dbal;

interface DoctrineCustomType
{
    public static function customTypeName(): string;
}
