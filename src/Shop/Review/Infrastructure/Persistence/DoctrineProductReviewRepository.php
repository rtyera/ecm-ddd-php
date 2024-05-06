<?php

declare(strict_types=1);

namespace TyCode\Shop\Review\Infrastructure\Persistence;

use TyCode\Shared\Domain\Criteria\Criteria;
use Doctrine\ORM\EntityManager;
use TyCode\Shared\Infrastructure\Doctrine\DoctrineTools;
use TyCode\Shared\Infrastructure\Persistence\Doctrine\DoctrineCriteriaConverter;
use TyCode\Shop\Review\Domain\Review;
use TyCode\Shop\Review\Domain\ReviewId;
use TyCode\Shop\Review\Domain\ReviewRepository;
use TyCode\Shop\Review\Domain\Reviews;

final class DoctrineProductReviewRepository implements ReviewRepository
{

    public function __construct(private readonly EntityManager $entityManager)
    {
    }

    public function save(Review $review): void
    {
        $this->entityManager->persist($review);
        $this->entityManager->flush($review);
    }

    public function search(ReviewId $id): ?Review
    {
        return $this->entityManager->getRepository(Review::class)->find($id);
    }

    public function searchAll(): ?Reviews
    {
        $reviews = $this->entityManager->getRepository(Review::class)->findAll();

        if(!$reviews){
            return null;
        }

        return new Reviews($reviews);

    }

    public function matching(Criteria $criteria): ?Reviews
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria, DoctrineTools::toDoctrineEmbeddedFields($criteria));
        $reviews = $this->entityManager->getRepository(Review::class)->matching($doctrineCriteria)->toArray();

        if(!$reviews){
            return null;
        }

        return new Reviews($reviews);
    }

}
