<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['product_id'] = $product->getId();

        Review::create($data);

        return redirect()->route('product.show', ['id' => $product->getId()])->with('success', __('review.submittedSuccess'));
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
