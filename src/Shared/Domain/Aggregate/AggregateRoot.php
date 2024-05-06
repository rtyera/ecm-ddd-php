<?php

declare(strict_types=1);

namespace TyCode\Shared\Domain\Aggregate;

use TyCode\Shared\Domain\Bus\Event\Event;

abstract class AggregateRoot
{
    private array $events = [];

    final public function pullEvents(): array
    {
        $events       = $this->events;
        $this->events = [];

        return $events;
    }

    final protected function record(Event $event): void
    {
        $this->events[] = $event;
    }
}
