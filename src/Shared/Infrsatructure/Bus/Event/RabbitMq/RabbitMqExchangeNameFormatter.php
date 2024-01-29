<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\Bus\Event\RabbitMq;

final class RabbitMqExchangeNameFormatter
{
    public static function retry(string $exchangeName): string
    {
        return "$exchangeName.retry";
    }

    public static function deadLetter(string $exchangeName): string
    {
        return "$exchangeName.dead_letter";
    }
}
