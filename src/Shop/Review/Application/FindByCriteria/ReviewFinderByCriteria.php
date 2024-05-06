<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\FindByCriteria;

use TyCode\Shared\Domain\Criteria\Criteria;
use TyCode\Shop\Review\Domain\Reviews;
use TyCode\Shop\Review\Domain\ReviewRepository;

final class ReviewFinderByCriteria
{
    public function __construct(private readonly ReviewRepository $repository)
    {
    }

    public function __invoke(Criteria $criteria): ?Reviews
    {
        $reviews = $this->repository->matching($criteria);

        return $reviews;
    }
}
