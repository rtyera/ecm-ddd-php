<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\FindByProductId;

use Exception;
use TyCode\Shared\Domain\Criteria\Criteria;
use TyCode\Shared\Domain\Criteria\Filter;
use TyCode\Shared\Domain\Criteria\FilterField;
use TyCode\Shared\Domain\Criteria\FilterOperator;
use TyCode\Shared\Domain\Criteria\Filters;
use TyCode\Shared\Domain\Criteria\FilterValue;
use TyCode\Shared\Domain\Criteria\Order;
use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shop\Review\Domain\Reviews;
use TyCode\Shop\Review\Domain\ReviewRepository;

final class ReviewFinderProductId
{
    public function __construct(private readonly ReviewRepository $repository)
    {
    }

    public function __invoke(ProductId $productId): Reviews
    {
        $criteria = new Criteria(
            new Filters([
                new Filter(
                    new FilterField('productId'),
                    new FilterOperator(FilterOperator::EQUAL),
                    new FilterValue($productId->value())
                )
            ]),
            Order::none(),
            null,
            null
        );

        $reviews = $this->repository->matching($criteria);

        if($reviews === null){
            throw new Exception(sprintf("Review with product id %s not exist", $productId->value()));
        }

        return $reviews;
    }
}
