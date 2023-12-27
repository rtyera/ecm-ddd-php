<?php

declare(strict_types=1);

namespace TyCode\Product\Application\Find;

use Exception;
use TyCode\Product\Domain\Product\Product;
use TyCode\Product\Domain\Product\ProductId;
use TyCode\Product\Domain\Product\ProductRepository;

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
