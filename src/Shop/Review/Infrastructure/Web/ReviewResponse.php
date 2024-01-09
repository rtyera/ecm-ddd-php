<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Infrastructure\Web;

use TyCode\Shop\Review\Domain\Review;
use TyCode\Shop\Review\Domain\Reviews;

use function Lambdish\Phunctional\map;

final class ReviewResponse
{
    public static function productsToArray(?Reviews $reviews): array
    {
        if(!$reviews){
            return [];
        }

        return map(
            fn(Review $review) => $review->toPrimitives(),
            $reviews
        );
    }
}
