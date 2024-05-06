<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\Create;

use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shop\Review\Domain\Review;
use TyCode\Shop\Review\Domain\ReviewAuthor;
use TyCode\Shop\Review\Domain\ReviewCreateOn;
use TyCode\Shop\Review\Domain\ReviewId;
use TyCode\Shop\Review\Domain\ReviewMessage;
use TyCode\Shop\Review\Domain\ReviewRepository;

final class ReviewCreator
{
    public function __construct(private readonly ReviewRepository $repository)
    {
    }

    public function __invoke(ReviewId $id,
                            ProductId $productId,
                            ReviewAuthor $author,
                            ReviewMessage $message,
                            ReviewCreateOn $createOn): void
    {
        $review = new Review($id, $productId, $author, $message, $createOn);

        $this->repository->save($review);
    }
}
