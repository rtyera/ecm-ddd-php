<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\FindByProductId;

use TyCode\Shared\Domain\Bus\Query\QueryHandler;
use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shop\Review\Application\ReviewsResponse;

final class FindReviewsByProductIdQueryHandler implements QueryHandler
{
    public function __construct(private readonly ReviewFinderProductId $finder)
    {
    }

    public function __invoke(FindReviewByProductIdQuery $query): ?ReviewsResponse
    {

        $reviews = $this->finder->__invoke(new ProductId($query->productId()));

        if(!$reviews){
            return null;
        }

        return new ReviewsResponse($reviews);
    }

}
