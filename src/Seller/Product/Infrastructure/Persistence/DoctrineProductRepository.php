<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Infrastructure\Persistence;

use TyCode\Seller\Product\Domain\Product;
use TyCode\Seller\Product\Domain\ProductRepository;
use TyCode\Shared\Domain\Criteria\Criteria;
use Doctrine\ORM\EntityManager;
use TyCode\Seller\Product\Domain\ProductId;
use TyCode\Seller\Product\Domain\Products;
use TyCode\Shared\Infrastructure\Doctrine\DoctrineTools;
use TyCode\Shared\Infrastructure\Persistence\Doctrine\DoctrineCriteriaConverter;

final class DoctrineProductRepository implements ProductRepository
{

    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush($product);
    }

    public function search(ProductId $id): ?Product
    {
        return $this->entityManager->getRepository(Product::class)->find($id);
    }

    public function searchAll(): ?Products
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        if(!$products){
            return null;
        }

        return new Products($products);

    }

    public function matching(Criteria $criteria): ?Products
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria, DoctrineTools::toDoctrineEmbeddedFields($criteria));
        $products = $this->entityManager->getRepository(Product::class)->matching($doctrineCriteria)->toArray();

        if(!$products){
            return null;
        }

        return new Products($products);
    }

}
