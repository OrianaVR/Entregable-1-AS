<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\ReviewService; 

class ReviewController extends Controller
{
    private ReviewService $reviewService; 

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    
    public function store(StoreReviewRequest $request, string $id): RedirectResponse
    {
       
        $this->reviewService->create($request->validated(), $id);

        return redirect()
            ->route('product.show', ['id' => $id])
            ->with('success', __('review.submittedSuccess'));
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

        return redirect()
            ->route('product.show', ['id' => $productId])
            ->with('success', __('review.deletedSuccess'));
    }
}