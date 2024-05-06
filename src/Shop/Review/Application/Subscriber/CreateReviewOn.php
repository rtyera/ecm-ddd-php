<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\Subscriber;

use TyCode\Shared\Domain\Bus\Command\CommandBus;
use TyCode\Shared\Domain\Bus\Event\EventSubscriber;
use TyCode\Shop\Review\Application\Create\CreateReviewCommand;
use TyCode\Shop\Review\Application\Event\CreateReviewEvent;

final class CreateReviewOn implements EventSubscriber
{
    public function __construct(private readonly CommandBus $commandBus)
    {
    }

    public static function subscribedTo(): array
    {
        return [CreateReviewEvent::class];
    }

    public function __invoke(CreateReviewEvent $event): void
    {
        $reviewCommand = new CreateReviewCommand(
            $event->aggregateId(),
            $event->productId(),
            $event->author(),
            $event->message(),
            $event->createOn()
        );

        $this->commandBus->dispatch($reviewCommand);
    }
}
