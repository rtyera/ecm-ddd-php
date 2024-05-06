<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application\AddReview;

use TyCode\Shared\Domain\Bus\Command\Command;

final class AddReviewCommand implements Command
{
    public function __construct(private readonly string $productId,
                                private readonly string $author,
                                private readonly string $message)
    {
    }

    public function productId(): string
    {
        return $this->productId;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function message(): string
    {
        return $this->message;
    }

}
