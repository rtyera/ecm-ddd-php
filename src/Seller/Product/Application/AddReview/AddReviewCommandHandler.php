<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application\AddReview;

use TyCode\Seller\Product\Domain\ProductId;
use TyCode\Seller\Review\Domain\ReviewAuthor;
use TyCode\Seller\Review\Domain\ReviewMessage;
use TyCode\Shared\Domain\Bus\Command\CommandHandler;

final class AddReviewCommandHandler implements CommandHandler
{
    public function __construct(private readonly AddReview $addReview)
    {
    }

    public function __invoke(AddReviewCommand $command): void
    {
        $productId = new ProductId($command->productId());
        $author = new ReviewAuthor($command->author());
        $message = new ReviewMessage($command->message());

        $this->addReview->__invoke( $productId, $author, $message);
    }
}
