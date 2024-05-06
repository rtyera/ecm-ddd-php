<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\Persistence\Doctrine;

use TyCode\Shared\Domain\Utils;
use TyCode\Shared\Infrastructure\Doctrine\Dbal\DoctrineCustomType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\JsonType;
use Exception;
use JsonException;
use ReflectionClass;
use ReflectionMethod;
use TyCode\Shared\Domain\ValueObject\JsonInterface;

use function Lambdish\Phunctional\last;

abstract class JsonCustomType extends JsonType implements DoctrineCustomType
{
    abstract protected function typeClassName(): string;

    public static function customTypeName(): string
    {
        return Utils::toSnakeCase(str_replace('Type', '', (string) last(explode('\\', static::class))));
    }

    public function getName(): string
    {
        return self::customTypeName();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        $this->validateClassType();

        if ($value === null || $value === '') {
            return null;
        }

        try {
            $primitives = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
            $className = $this->typeClassName();

            $reflectionMethod = new ReflectionMethod($className, 'fromPrimitives');
            return $reflectionMethod->invoke(null, $primitives);
        } catch (JsonException $e) {
            throw ConversionException::conversionFailed($value, $this->getName(), $e);
        }
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        $this->validateClassType();

        if(!isset($value)){
            return null;
        }

        try {
            return json_encode($value->value(), JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
        } catch (JsonException $e) {
            throw ConversionException::conversionFailedSerialization($value, 'json', $e->getMessage(), $e);
        }
    }

    private function validateClassType(): void
    {
        $reflectionClass = new ReflectionClass($this->typeClassName());

        if(!$reflectionClass->implementsInterface(JsonInterface::class)){
            throw new Exception(sprintf("Invalid class %s for JsonCustomType. It may implement the interface: JsonTypeInterface", $this->typeClassName()));
        }
    }
}
