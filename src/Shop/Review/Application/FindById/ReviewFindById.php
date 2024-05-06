<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\FindById;

use Exception;
use TyCode\Shop\Review\Domain\ReviewId;
use TyCode\Shop\Review\Domain\Review;
use TyCode\Shop\Review\Domain\ReviewRepository;

final class ReviewFindById
{
    public function __construct(private readonly ReviewRepository $repository)
    {
    }

    public function __invoke(ReviewId $reviewId): Review
    {
        // $criteria = new Criteria(
        //     new Filters([
        //         new Filter(
        //             new FilterField('productId'),
        //             new FilterOperator(FilterOperator::EQUAL),
        //             new FilterValue($productId->value())
        //         )
        //     ]),
        //     Order::none(),
        //     null,
        //     null
        // );

        // $reviews = $this->repository->matching($criteria);
        $review = $this->repository->search($reviewId);

        if($review === null){
            throw new Exception(sprintf("Review with product id %s not exist", $reviewId->value()));
        }

        return $review;
    }
}
