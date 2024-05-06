<?php

declare(strict_types=1);

namespace TyCode\Seller\Review\Application\Create;

use TyCode\Seller\Product\Domain\ProductId;
use TyCode\Shared\Domain\Bus\Command\CommandHandler;
use TyCode\Shared\Domain\Bus\Event\EventBus;
use TyCode\Seller\Review\Application\Event\CreateReviewEvent;
use TyCode\Seller\Review\Domain\ReviewAuthor;
use TyCode\Seller\Review\Domain\ReviewCreateOn;
use TyCode\Seller\Review\Domain\ReviewId;
use TyCode\Seller\Review\Domain\ReviewMessage;

final class CreateReviewCommandHandler implements CommandHandler
{
    public function __construct(private readonly EventBus $eventBus)
    {
    }

    public function __invoke(CreateReviewCommand $command): void
    {
        $id             = new ReviewId($command->id());
        $productId      = new ProductId($command->productId());
        $author         = new ReviewAuthor($command->author());
        $message        = new ReviewMessage($command->message());
        $createOn       = ReviewCreateOn::now();

        $this->eventBus->publish(new CreateReviewEvent(
            $id->value(),
            $productId->value(),
            $author->value(),
            $message->value(),
            $createOn->value()
        ));

    }
}
