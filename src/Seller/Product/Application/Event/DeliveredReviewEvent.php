<?php

namespace TyCode\Seller\Product\Application\Event;

use TyCode\Shared\Domain\Bus\Event\Event;

class DeliveredReviewEvent extends Event
{

    public function __construct(
        string $id,
        private readonly string $productId,
        private readonly string $author,
        private readonly string $message,
        string $eventId = null,
        string $occurredOn = null) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'review.delivered';
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
                        $eventId,
                        $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'productId' => $this->productId,
            'author' => $this->author,
            'message' => $this->message
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

}