<?php

declare(strict_types=1);

namespace TyCode\Shared\Domain\ValueObject;

use DateTime;

abstract class DateValueObject
{
    public function __construct(protected DateTime $value)
    {
    }

    public function value(): DateTime
    {
        return $this->value;
    }

}
