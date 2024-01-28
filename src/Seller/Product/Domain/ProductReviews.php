<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Domain;

use TyCode\Shared\Domain\ValueObject\JsonInterface;

final class ProductReviews implements JsonInterface
{
    function __construct(private readonly ?Reviews $value){}

    public function value(): ?array
    {
        if(!$this->value){
            return null;
        }

        return $this->toPrimitives();
    }

    public function toPrimitives(): array
    {
        $primitivesReviews = [];

        /** @var Review $value */
        foreach ($this->value->items() as $value) {
            $primitivesReviews[] = $value->toPrimitives();
        }

        return $primitivesReviews;
    }

    public static function fromPrimitives(?array $primitives): mixed
    {
        if(!$primitives){
            return new self(null);
        }

        $reviews = [];
        foreach ($primitives as $value) {
            $reviews[] = Review::fromPrimitives($value);
        }
        return new self(new Reviews($reviews));
    }

    public function __toString(): string
    {
        return 'product_reviews';
    }

}
