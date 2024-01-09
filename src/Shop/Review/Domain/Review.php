<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Domain;

use DateTime;
use DateTimeInterface;
use TyCode\Shared\Domain\Aggregate\AggregateRoot;
use TyCode\Shop\Product\Domain\ProductId;

final class Review extends AggregateRoot
{
    public function __construct(private readonly ReviewId $id,
                                private readonly ProductId $productId,
                                private readonly ReviewAuthor $author,
                                private readonly ReviewMessage $message,
                                private readonly ReviewCreateOn $createOn)
    {
    }

    public static function create(ReviewId $id,
                                ProductId $productId,
                                ReviewAuthor $author,
                                ReviewMessage $message,
                                ReviewCreateOn $createOn): self
    {
        return new self($id, $productId, $author, $message, $createOn);
    }

    public function id(): string
    {
        return $this->id->value();
    }

    public function productId(): string
    {
        return $this->productId->value();
    }

    public function author(): string
    {
        return $this->author->value();
    }

    public function message(): string
    {
        return $this->message->value();
    }

    public function createOn(): DateTime
    {
        return $this->createOn->value();
    }

    public function toPrimitives(): array
    {
        return [
            'id'            => $this->id->value(),
            'productId'     => $this->productId->value(),
            'author'        => $this->author->value(),
            'message'       => $this->message->value(),
            'createOn'      => $this->createOn->value()->format(DateTimeInterface::ATOM)
        ];
    }

}
