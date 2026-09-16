<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, string $id): RedirectResponse
    {
        $this->createReviewForProduct($request->validated(), (int) $id, Auth::id());

        return redirect()->route('product.show', ['id' => $id])->with('success', __('review.submittedSuccess'));
    }

    public function delete(string $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        /** @var User $user */
        $user = Auth::user();

        if ($review->getUserId() !== $user->getId() && $user->getRole() !== 'admin') {
            abort(403);
        }

        $productId = $review->getProductId();
        $review->delete();

        return redirect()->route('product.show', ['id' => $productId])->with('success', __('review.deletedSuccess'));
    }

    private function createReviewForProduct(array $reviewData, int $productId, int $userId): Review
    {
        return DB::transaction(function () use ($reviewData, $productId, $userId): Review {
            $product = Product::findOrFail($productId);

            $reviewData['product_id'] = $productId;
            $reviewData['user_id'] = $userId;

            $review = Review::create($reviewData);

            $product->setFeatured($product->getAverageRating() >= 4);
            $product->save();

            return $review;
        });
    }
}
