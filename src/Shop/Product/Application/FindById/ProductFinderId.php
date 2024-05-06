<?php

declare(strict_types=1);

namespace TyCode\Shop\Product\Application\FindById;

use Exception;
use TyCode\Shop\Product\Domain\Product;
use TyCode\Shop\Product\Domain\ProductId;
use TyCode\Shop\Product\Domain\ProductRepository;

final class ProductFinderId
{
    public function __construct(private readonly ProductRepository $repository)
    {
    }

    public function __invoke(ProductId $productId): Product
    {
        $product=$this->repository->search($productId);

        if($product === null){
            throw new Exception(sprintf("Product with id %s not exist", $productId->value()));
        }

        return $product;
    }
}
