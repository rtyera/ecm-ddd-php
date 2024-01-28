<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\Checker;

use DateTime;
use TyCode\Shared\Domain\Bus\Command\Command;

final class CheckerReviewCommand implements Command
{
    public function __construct(private readonly string $id, private readonly bool $deliver)
    {
    }

    public function id(): string
    {
        return $this->id;
    }


    public function deliver(): bool
    {
        return $this->deliver;
    }

}
