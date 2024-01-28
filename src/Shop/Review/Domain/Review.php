<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Domain;

use DateTime;
use DateTimeInterface;
use TyCode\Shared\Domain\Aggregate\AggregateRoot;
use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shop\Review\Domain\Event\DeliveredReviewEvent;

final class Review extends AggregateRoot
{
    public function __construct(private readonly ReviewId $id,
                                private readonly ProductId $productId,
                                private readonly ReviewAuthor $author,
                                private readonly ReviewMessage $message,
                                private readonly ReviewCreateOn $createOn,
                                private bool $deliver = false,
                                private bool $checker = false)
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

    public function deliver(): bool
    {
        return $this->deliver;
    }

    public function checker(): bool
    {
        return $this->checker;
    }

    public function checked() : void
    {
        $this->checker = true;
    }

    public function delivered() : void
    {
        $this->deliver = true;

        $this->record(new DeliveredReviewEvent(
            $this->id(),
            $this->productId(),
            $this->author(),
            $this->message()
        ));
    }

    public function toPrimitives(): array
    {
        return [
            'id'            => $this->id->value(),
            'productId'     => $this->productId->value(),
            'author'        => $this->author->value(),
            'message'       => $this->message->value(),
            'createOn'      => $this->createOn->value()->format(DateTimeInterface::ATOM),
            'deliver'       => $this->deliver,
            'check'         => $this->checker
        ];
    }

}
