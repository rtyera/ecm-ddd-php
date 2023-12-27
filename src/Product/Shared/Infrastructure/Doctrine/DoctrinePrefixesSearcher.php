<?php

declare(strict_types=1);

namespace TyCode\Product\Shared\Infrastructure\Doctrine;

use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reindex;

final class DoctrinePrefixesSearcher
{
    private const MAPPINGS_PATH = 'Infrastructure/Persistence/Doctrine';

    public static function inPath(string $path, string $baseNamespace): array
    {
        $mappingsPath = self::MAPPINGS_PATH;
        $tempPath = realpath("$path/$mappingsPath");

        $mappingDirectories = self::possibleMappingPaths($tempPath);

        return array_flip(reindex(self::namespaceFormatter($baseNamespace), $mappingDirectories));
    }

    private static function modulesInPath(string $path): array
    {
        return filter(
            static fn (string $possibleModule) => !in_array($possibleModule, ['.', '..'], true),
            scandir($path)
        );
    }

    private static function possibleMappingPaths(string $path): array
    {
        return map(
            static function ($unused, string $module) use ($path) {
                return realpath("$path/$module");
            },
            array_flip(self::modulesInPath($path))
        );
    }

    // private static function isExistingMappingPath(): callable
    // {
    //     return static fn (string $path) => !empty($path);
    // }

    private static function namespaceFormatter(string $baseNamespace): callable
    {
        return static fn (string $path, string $module) => "$baseNamespace\Domain\\$module";
    }
}
