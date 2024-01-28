<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\Create;

use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shared\Domain\Bus\Command\CommandHandler;
use TyCode\Shared\Domain\Bus\Event\EventBus;
use TyCode\Shop\Review\Domain\ReviewAuthor;
use TyCode\Shop\Review\Domain\ReviewCreateOn;
use TyCode\Shop\Review\Domain\ReviewId;
use TyCode\Shop\Review\Domain\ReviewMessage;

final class CreateReviewCommandHandler implements CommandHandler
{
    public function __construct(private readonly EventBus $eventBus, private readonly ReviewCreator $reviewCreator)
    {
    }

    public function __invoke(CreateReviewCommand $command): void
    {
        $id             = new ReviewId($command->id());
        $productId      = new ProductId($command->productId());
        $author         = new ReviewAuthor($command->author());
        $message        = new ReviewMessage($command->message());
        $createOn       = new ReviewCreateOn($command->createOn());

        $this->reviewCreator->__invoke($id, $productId, $author, $message, $createOn);

    }
}
