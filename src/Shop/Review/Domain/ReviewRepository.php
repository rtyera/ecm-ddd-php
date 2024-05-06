<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Domain;

use TyCode\Shared\Domain\Criteria\Criteria;

interface ReviewRepository
{
    public function save(Review $course): void;

    public function search(ReviewId $id): ?Review;

    public function searchAll(): ?Reviews;

    public function matching(Criteria $criteria): ?Reviews;
}
