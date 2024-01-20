<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\Subscriber;

use TyCode\Shared\Domain\Bus\Event\EventSubscriber;
use TyCode\Shop\Review\Application\CQRS\Event\CreatedReviewEvent;

final class CreateReviewOn implements EventSubscriber
{
    public function __construct()
    {
    }

    public static function subscribedTo(): array
    {
        return [CreatedReviewEvent::class];
    }

    public function __invoke(CreatedReviewEvent $event): void
    {
        var_dump('from subscriber');
    }
}
