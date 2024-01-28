<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application\Subscriber;

use TyCode\Seller\Product\Application\AddReview\AddReviewCommand;
use TyCode\Seller\Product\Application\Event\DeliveredReviewEvent;
use TyCode\Shared\Domain\Bus\Command\CommandBus;
use TyCode\Shared\Domain\Bus\Event\EventSubscriber;

final class DeliveredReviewOn implements EventSubscriber
{
    public function __construct(private readonly CommandBus $commandBus){}

    public static function subscribedTo(): array
    {
        return [DeliveredReviewEvent::class];
    }

    public function __invoke(DeliveredReviewEvent $event): void
    {
        $this->commandBus->dispatch(new AddReviewCommand(
            $event->productId(),
            $event->author(),
            $event->message()
        ));
    }
}
