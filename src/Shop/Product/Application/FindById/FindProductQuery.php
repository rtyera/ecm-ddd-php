<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application\FindById;

use TyCode\Shared\Domain\Bus\Query\Query;


final class FindProductQuery implements Query
{
    public function __construct(private readonly string $id){}

    public function id(): string
    {
        return $this->id;
    }

}
