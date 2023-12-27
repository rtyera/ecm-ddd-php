<?php

declare(strict_types=1);

namespace TyCode\Shared\Domain\Criteria;

use InvalidArgumentException;
use TyCode\Shared\Domain\ValueObject\Enum;

/**
 * @method static FilterOperator gt()
 * @method static FilterOperator lt()
 * @method static FilterOperator like()
 */
final class FilterOperator extends Enum
{
    public const EQUAL        = '=';
    public const NOT_EQUAL    = '!=';
    public const GT           = '>';
    public const LT           = '<';
    public const IN           = 'IN';
    public const NOT_IN       = 'NIN';
    private static array $containing = [self::IN, self::NOT_IN];

    public function isContaining(): bool
    {
        return in_array($this->value(), self::$containing, true);
    }

    protected function throwExceptionForInvalidValue($value): never
    {
        throw new InvalidArgumentException(sprintf('The filter <%s> is invalid', $value));
    }
}
