<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Interfaces\ReviewCreation;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    private ReviewCreation $reviewCreation;

    public function __construct(ReviewCreation $reviewCreation)
    {
        $this->reviewCreation = $reviewCreation;
    }

    public function store(StoreReviewRequest $request, string $id): RedirectResponse
    {
        $this->reviewCreation->createForProduct($request->validated(), (int) $id, Auth::id());

        return redirect()->route('product.show', ['id' => $id])->with('success', __('review.submittedSuccess'));
    }

    public function delete(string $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $user = Auth::user();

        if ($review->getUserId() !== $user->getId() && $user->getRole() !== 'admin') {
            abort(403);
        }

        $productId = $review->getProductId();
        $review->delete();

        return redirect()->route('product.show', ['id' => $productId])->with('success', __('review.deletedSuccess'));
    }
}
