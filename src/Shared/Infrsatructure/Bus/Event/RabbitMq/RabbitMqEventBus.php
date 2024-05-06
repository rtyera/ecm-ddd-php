<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\Bus\Event\RabbitMq;

use AMQPException;
use TyCode\Shared\Domain\Bus\Event\Event;
use TyCode\Shared\Domain\Bus\Event\EventBus;
use TyCode\Shared\Infrastructure\Bus\Event\EventJsonSerializer;
use function Lambdish\Phunctional\each;

final class RabbitMqEventBus implements EventBus
{
    public function __construct(
        private readonly RabbitMqConnection $connection,
        private readonly string $exchangeName,
    ) {
    }

    public function publish(Event ...$events): void
    {
        each($this->publisher(), $events);
    }

    private function publisher(): callable
    {
        return function (Event $event): void {
            try {
                $this->publishEvent($event);
            } catch (AMQPException) {
                //$this->failoverPublisher->publish($event);
            }
        };
    }

    private function publishEvent(Event $event): void
    {
        $body       = EventJsonSerializer::serialize($event);
        $routingKey = $event::eventName();
        $messageId  = $event->eventId();

        $this->connection->exchange($this->exchangeName)->publish(
            $body,
            $routingKey,
            AMQP_NOPARAM,
            [
                'message_id'       => $messageId,
                'content_type'     => 'application/json',
                'content_encoding' => 'utf-8',
            ]
        );
    }
}
