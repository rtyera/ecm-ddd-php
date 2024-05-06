<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\FindByCriteria;

use TyCode\Shared\Domain\Bus\Query\QueryHandler;
use TyCode\Shop\Review\Application\ReviewsResponse;

final class FindReviewsByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private readonly ReviewFinderByCriteria $finder)
    {
    }

    public function __invoke(FindReviewsByCriteriaQuery $query): ?ReviewsResponse
    {

        $reviews = $this->finder->__invoke($query->criteria());

        if(!$reviews){
            return null;
        }

        return new ReviewsResponse($reviews);
    }

}
