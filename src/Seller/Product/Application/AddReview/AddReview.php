<?php

declare(strict_types=1);

namespace TyCode\Seller\Product\Application\AddReview;

use TyCode\Seller\Product\Application\FindById\ProductFinderId;
use TyCode\Seller\Product\Domain\ProductId;
use TyCode\Seller\Product\Domain\ProductRepository;
use TyCode\Seller\Product\Domain\Review;
use TyCode\Seller\Review\Domain\ReviewAuthor;
use TyCode\Seller\Review\Domain\ReviewMessage;

final class AddReview
{
    public function __construct(
        private readonly ProductRepository $repository,
        private readonly ProductFinderId $productFinderId){}

    public function __invoke(ProductId $id,
                            ReviewAuthor $author,
                            ReviewMessage $message): void
    {
        $product = $this->productFinderId->__invoke($id);

        $product->addReviews(new Review($author->value(), $message->value()));
        $this->repository->save($product);
    }
}
