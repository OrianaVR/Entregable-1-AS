<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\Review;

class ReviewService
{
    public function create(array $reviewData, int $productId): Review
    {
        $review = new Review();

        $review->setProductId($productId);
        $review->setRating($reviewData['rating']);
        $review->setComments($reviewData['comments']);

        $review->save();

        $this->updateFeaturedStatus($productId);

        return $review;
    }

    private function updateFeaturedStatus(int $productId): void
    {
        $averageRating = Review::where('product_id', $productId)
            ->avg('rating');

        $product = Product::findOrFail($productId);

        $product->setFeatured($averageRating >= 4);
        $product->save();
    }
}