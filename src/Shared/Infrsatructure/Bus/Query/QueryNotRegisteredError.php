<?php

declare(strict_types=1);

namespace TyCode\Shared\Infrastructure\Bus\Query;

use TyCode\Shared\Domain\Bus\Query\Query;
use RuntimeException;

final class QueryNotRegisteredError extends RuntimeException
{
    public function __construct(Query $query)
    {
        $queryClass = $query::class;

        parent::__construct("The query <$queryClass> hasn't a query handler associated");
    }
}
