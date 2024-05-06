<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application\Subscriber;

use TyCode\Seller\Product\Application\Create\CreateProductCommand;
use TyCode\Seller\Product\Application\Event\CreatedProductEvent;
use TyCode\Shared\Domain\Bus\Command\CommandBus;
use TyCode\Shared\Domain\Bus\Event\EventSubscriber;

final class CreatedProductOn implements EventSubscriber
{
    public function __construct(private readonly CommandBus $commandBus)
    {
    }

    public static function subscribedTo(): array
    {
        return [CreatedProductEvent::class];
    }

    public function __invoke(CreatedProductEvent $event): void
    {
        $createProductCommand = new CreateProductCommand(
            $event->aggregateId(),
            $event->name(),
            $event->price(),
            $event->images(),
            $event->stockQuantity()
        );

        $this->commandBus->dispatch($createProductCommand);
    }
}
