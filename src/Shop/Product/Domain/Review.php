<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Domain;

final class Review
{
    function __construct(private readonly string $message, private readonly string $authorFullName)
    {
    }

    public function message(): string
    {
        return $this->message;
    }

    public function authorFullName(): string
    {
        return $this->authorFullName;
    }

    public function toPrimitives(): array
    {
        return [
            'message'        => $this->message,
            'authorFullName' => $this->authorFullName,
        ];
    }

    public static function fromPrimitives(array $primitives): self
    {
        return new self($primitives['message'], $primitives['authorFullName']);
    }

}
