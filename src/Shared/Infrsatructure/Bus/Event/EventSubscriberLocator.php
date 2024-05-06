<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\Bus\Event;

use TyCode\Shared\Domain\Bus\Event\EventSubscriber;
use TyCode\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use TyCode\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqQueueNameFormatter;
use RuntimeException;
use Traversable;
use function Lambdish\Phunctional\search;

final class EventSubscriberLocator
{
    private readonly array $mapping;

    public function __construct(Traversable $mapping)
    {
        $this->mapping = iterator_to_array($mapping);
    }

    public function allSubscribedTo(string $eventClass): array
    {
        $formatted = CallableFirstParameterExtractor::forPipedCallables($this->mapping);

        return $formatted[$eventClass];
    }

    public function withRabbitMqQueueNamed(string $queueName): EventSubscriber|callable
    {
        $subscriber = search(
            static fn (EventSubscriber $subscriber) => RabbitMqQueueNameFormatter::format($subscriber) ===
                                                            $queueName,
            $this->mapping
        );

        if (null === $subscriber) {
            throw new RuntimeException("There are no subscribers for the <$queueName> queue");
        }

        return $subscriber;
    }

    public function all(): array
    {
        return $this->mapping;
    }
}
