<?php

declare(strict_types=1);

namespace TyCode\Product\Shared\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use TyCode\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;

final class ProductEntityManagerFactory
{
    private const SCHEMA_PATH = __DIR__ . '/../../../../../etc/databases/product.sql';

    public static function create(array $parameters, string $environment): EntityManagerInterface
    {
        $isDevMode = 'prod' !== $environment;

        /*example: [TyCode\Product\Domain\$module : TyCode\Product\Infrastructure\Persistence\Doctrine\$module] */
        $prefixes = DoctrinePrefixesSearcher::inPath(__DIR__ . '/../../../../Product', 'TyCode\Product');

        $dbalCustomTypesClasses = DbalTypesSearcher::inPath(__DIR__ . '/../../../../Product', 'Product');

        return DoctrineEntityManagerFactory::create(
            $parameters,
            $prefixes,
            $isDevMode,
            self::SCHEMA_PATH,
            $dbalCustomTypesClasses
        );
    }
}
