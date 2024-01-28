<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\Checker;

use TyCode\Shared\Domain\Bus\Event\EventBus;
use TyCode\Shop\Review\Application\FindById\ReviewFindById;
use TyCode\Shop\Review\Domain\ReviewId;
use TyCode\Shop\Review\Domain\ReviewRepository;

final class ReviewChecker
{
    public function __construct(
        private readonly EventBus $eventBus,
        private readonly ReviewRepository $reviewRepository,
        private readonly ReviewFindById $reviewFindById
    ){}

    public function __invoke(ReviewId $id, bool $deliver) : void
    {
        $review = $this->reviewFindById->__invoke($id);

        $review->checked();
        if($deliver){
            $review->delivered();
        }

        $this->reviewRepository->save($review);
        $this->eventBus->publish(...$review->pullEvents());
    }

}
