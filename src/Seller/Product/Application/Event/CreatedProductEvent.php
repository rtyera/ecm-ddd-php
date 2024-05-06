<?php

namespace TyCode\Seller\Product\Application\Event;

use TyCode\Shared\Domain\Bus\Event\Event;

class CreatedProductEvent extends Event
{

    public function __construct(
        string $id,
        private readonly string $name,
        private readonly float $price,
        private readonly array $images,
        private readonly int $stockQuantity,
        string $eventId = null,
        string $occurredOn = null) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'product.created';
    }

    public static function fromPrimitives(  string $aggregateId,
                                            array $body,
                                            string $eventId,
                                            string $occurredOn
                                            ): Event
    {
        return new self($aggregateId,
                        $body['name'],
                        (float)$body['price'],
                        $body['images'],
                        (int)$body['stockQuantity'],
                        $eventId,
                        $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'images' => $this->images,
            'stockQuantity' => $this->stockQuantity
        ];
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function images(): array
    {
        return $this->images;
    }

    public function stockQuantity(): int
    {
        return $this->stockQuantity;
    }

}
