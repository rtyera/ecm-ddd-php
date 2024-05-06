<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Application\Checker;

use TyCode\Shared\Domain\Bus\Command\CommandHandler;
use TyCode\Shop\Review\Domain\ReviewId;

final class CheckerReviewCommandHandler implements CommandHandler
{
    public function __construct(private readonly ReviewChecker $reviewChecker){}

    public function __invoke(CheckerReviewCommand $command): void
    {
        $this->reviewChecker->__invoke(new ReviewId($command->id()), $command->deliver());
    }
}