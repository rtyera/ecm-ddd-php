<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Domain;

final class Review
{
    function __construct(private readonly string $author, private readonly string $message)
    {
    }

    public function message(): string
    {
        return $this->message;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function toPrimitives(): array
    {
        return [
            'author'   => $this->author,
            'message'  => $this->message,
        ];
    }

    public static function fromPrimitives(array $primitives): self
    {
        return new self($primitives['author'], $primitives['message']);
    }

}
