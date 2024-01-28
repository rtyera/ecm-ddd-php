<?php

declare(strict_types=1);

namespace TyCode\Seller\Review\Application\Create;

use TyCode\Shared\Domain\Bus\Command\Command;

final class CreateReviewCommand implements Command
{
    public function __construct(private readonly string $id,
                                private readonly string $productId,
                                private readonly string $author,
                                private readonly string $message)
    {
    }

    public function id(): string
    {
        return $this->id;
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
