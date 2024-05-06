<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\Bus\Event;

use TyCode\Shared\Domain\Bus\Event\Event;

final class EventJsonSerializer
{
    public static function serialize(Event $event): string
    {
        return json_encode(
            [
                'data' => [
                    'id'          => $event->eventId(),
                    'type'        => $event::eventName(),
                    'occurred_on' => $event->occurredOn(),
                    'attributes'  => array_merge($event->toPrimitives(), ['id' => $event->aggregateId()]),
                ],
                'meta' => [],
            ]
        );
    }
}
