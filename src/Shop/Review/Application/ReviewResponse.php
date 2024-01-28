<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application;

use TyCode\Shop\Review\Domain\Review;
use TyCode\Shared\Domain\Bus\Query\Response;

final class ReviewResponse implements Response
{

    public function __construct(private readonly Review $review){}

    public function review(): Review
    {
        return $this->review;
    }
}
