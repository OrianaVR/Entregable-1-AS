<h1>{{ $viewData['product']->getName() }}</h1>

@if ($viewData['product']->getFeatured())
    <span class="badge bg-warning">
        ⭐ Featured Product
    </span>
@endif

<div class="mb-3">
    @for ($star = 1; $star <= 5; $star++)
        @if ($star <= round($viewData['averageRating']))
            ⭐
        @else
            ☆
        @endif
    @endfor
</div>

<div class="mt-4">
    <h3>Rate this product</h3>

    <form action="{{ route('review.save', ['id' => $viewData['product']->getId()]) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Rating</label>

            <div>
                <input type="radio" name="rating" value="1" id="star1">
                <label for="star1">⭐</label>

                <input type="radio" name="rating" value="2" id="star2">
                <label for="star2">⭐⭐</label>

                <input type="radio" name="rating" value="3" id="star3">
                <label for="star3">⭐⭐⭐</label>

                <input type="radio" name="rating" value="4" id="star4">
                <label for="star4">⭐⭐⭐⭐</label>

                <input type="radio" name="rating" value="5" id="star5">
                <label for="star5">⭐⭐⭐⭐⭐</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="comments" class="form-label">Comment</label>
            <textarea name="comments" id="comments" class="form-control" rows="4">{{ old('comments') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>