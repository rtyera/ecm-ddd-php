<?php

declare(strict_types=1);

namespace TyCode\Product\Shared\Infrastructure\Doctrine;

use TyCode\Shared\Domain\Utils;

use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reduce;

final class DbalTypesSearcher
{
    private const MAPPINGS_PATH = 'Infrastructure/Persistence/Doctrine';

    public static function inPath(string $path, string $contextName): array
    {
        $mappingsPath = self::MAPPINGS_PATH;
        $tempPath = realpath("$path/$mappingsPath");

        $dbalDirectories = self::possibleDbalPaths($tempPath);

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
                return realpath("$path/$module");
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
                    // $fullPath     = "$path/$file"; /**for linus system */
                    $splittedPath = explode("\src\\$contextName\\", $fullPath);
                    // $splittedPath = explode("/src/$contextName/", $fullPath); /**for linus system */
                    $classWithoutPrefix = str_replace(['.php', '/'], ['', '\\'], $splittedPath[1]);

                    return "TyCode\\$contextName\\$classWithoutPrefix";
                },
                $files
            );

            return array_merge($totalNamespaces, $namespaces);
        };
    }
}
