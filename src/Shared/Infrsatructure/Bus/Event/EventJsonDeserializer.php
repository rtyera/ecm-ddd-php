<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\Bus\Event;

use TyCode\Shared\Domain\Bus\Event\Event;
use TyCode\Shared\Domain\Utils;
use RuntimeException;

final class EventJsonDeserializer
{
    public function __construct(private readonly EventMapping $mapping)
    {
    }

    public function deserialize(string $event): Event
    {
        $eventData  = Utils::jsonDecode($event);
        $eventName  = $eventData['data']['type'];
        $eventClass = $this->mapping->for($eventName);

        if (null === $eventClass) {
            throw new RuntimeException("The event <$eventName> doesn't exist or has no subscribers");
        }

        return $eventClass::fromPrimitives(
            $eventData['data']['attributes']['id'],
            $eventData['data']['attributes'],
            $eventData['data']['id'],
            $eventData['data']['occurred_on']
        );
    }
}
