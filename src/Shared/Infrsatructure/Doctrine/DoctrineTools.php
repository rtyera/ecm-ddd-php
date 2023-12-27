<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\Doctrine;

use TyCode\Shared\Domain\Criteria\Criteria;
use TyCode\Shared\Domain\Criteria\Filter;

use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\reindex;

final class DoctrineTools
{

    public static function toDoctrineEmbeddedFields(Criteria $criteria): array
    {
        return map(
            fn(Filter $filter) => $filter->field()->value().'.value',
            reindex(
                fn(Filter $filter) => $filter->field()->value(),
                $criteria->filters()->filters()
            )
        );
    }
}
