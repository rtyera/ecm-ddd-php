<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application;

use TyCode\Shop\Review\Domain\Reviews;
use TyCode\Shared\Domain\Bus\Query\Response;

final class ReviewsResponse implements Response
{

    public function __construct(private readonly Reviews $reviews){}

    public function reviews(): Reviews
    {
        return $this->reviews;
    }
}
