<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\Bus\Event\RabbitMq;

use TyCode\Shared\Domain\Bus\Event\EventSubscriber;
use TyCode\Shared\Domain\Utils;
use function Lambdish\Phunctional\last;
use function Lambdish\Phunctional\map;

final class RabbitMqQueueNameFormatter
{
    public static function format(EventSubscriber $subscriber): string
    {
        $subscriberClassPaths = explode('\\', get_class($subscriber));

        $queueNameParts = [
            'ecm',
            $subscriberClassPaths[1],
            last($subscriberClassPaths),
        ];

        return implode('.', map(self::toSnakeCase(), $queueNameParts));
    }

    public static function formatRetry(EventSubscriber $subscriber): string
    {
        $queueName = self::format($subscriber);

        return "$queueName.retry";
    }

    public static function formatDeadLetter(EventSubscriber $subscriber): string
    {
        $queueName = self::format($subscriber);

        return "$queueName.dead_letter";
    }

    public static function shortFormat(EventSubscriber $subscriber): string
    {
        $subscriberCamelCaseName = (string) last(explode('\\', $subscriber::class));

        return Utils::toSnakeCase($subscriberCamelCaseName);
    }

    private static function toSnakeCase(): callable
    {
        return static fn (string $text) => Utils::toSnakeCase($text);
    }
}
