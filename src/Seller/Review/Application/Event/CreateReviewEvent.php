<?php

namespace TyCode\Seller\Review\Application\Event;

use DateTime;
use DateTimeInterface;
use TyCode\Shared\Domain\Bus\Event\Event;

class CreateReviewEvent extends Event
{

    public function __construct(
        string $id,
        private readonly string $productId,
        private readonly string $author,
        private readonly string $message,
        private readonly DateTime $createOn,
        string $eventId = null,
        string $occurredOn = null) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'review.create';
    }

    public static function fromPrimitives(  string $aggregateId,
                                            array $body,
                                            string $eventId,
                                            string $occurredOn
                                            ): Event
    {
        return new self($aggregateId,
                        $body['productId'],
                        $body['author'],
                        $body['message'],
                        new DateTime($body['createOn']),
                        $eventId,
                        $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'productId' => $this->productId,
            'author' => $this->author,
            'message' => $this->message,
            'createOn' => $this->createOn->format(DateTimeInterface::ATOM)
        ];
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

    public function createOn(): DateTime
    {
        return $this->createOn;
    }

}
