<?php

declare(strict_types=1);

namespace TyCode\Shop\Shared\Infrastructure\Doctrine;

use TyCode\Shared\Domain\Utils;

use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reduce;

final class DbalTypesSearcher
{
    private const MAPPINGS_PATH = 'Infrastructure/Persistence/Doctrine';

    public static function inPath(string $path, string $contextName): array
    {
        $possibleDbalDirectories = self::possibleDbalPaths($path);
        $dbalDirectories         = filter(self::isExistingDbalPath(), $possibleDbalDirectories);

        return reduce(self::dbalClassesSearcher($contextName), $dbalDirectories, []);
    }

    private static function modulesInPath(string $path): array
    {
        return filter(
            static fn (string $possibleModule) => !in_array($possibleModule, ['.', '..'], true),
            scandir($path)
        );
    }

    private static function possibleDbalPaths(string $path): array
    {
        return map(
            static function ($unused, string $module) use ($path) {
                $mappingsPath = self::MAPPINGS_PATH;
                return realpath("$path/$module/$mappingsPath");
            },
            array_flip(self::modulesInPath($path))
        );
    }

    private static function dbalClassesSearcher(string $contextName): callable
    {
        return static function (array $totalNamespaces, string $path) use ($contextName) {
            $possibleFiles = scandir($path);
            $files         = filter(
                static fn ($file) => Utils::endsWith('Type.php', $file),
                $possibleFiles
            );

            $namespaces = map(
                static function (string $file) use ($path, $contextName) {
                    $fullPath     = $path.'\\'.$file;
                    // $fullPath     = "$path/$file"; /**for linux system */
                    $splittedPath = explode("\src\\$contextName\\", $fullPath);
                    // $splittedPath = explode("/src/$contextName/", $fullPath); /**for linux system */
                    $classWithoutPrefix = str_replace(['.php', '/'], ['', '\\'], $splittedPath[1]);

                    return "TyCode\\$contextName\\$classWithoutPrefix";
                },
                $files
            );

            return array_merge($totalNamespaces, $namespaces);
        };
    }

    private static function isExistingDbalPath(): callable
    {
        return static fn (string $path) => !empty($path);
    }
}
