@extends('layouts.app')
@section('content')

<div class="container py-5 hero-content">
    <h1>
        {{ $viewData['title'] }}
        <br>
        <em>{{ $viewData['subtitle'] }}</em>
    </h1>
</div>

<div class="container">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-3">
        <div class="row g-0">

            <img src="{{ asset('images/products/'.$viewData['product']->getImage()) }}"
                 class="img-fluid rounded-start"
                 alt="{{ $viewData['product']->getName() }}">

            <div class="col-md-8">
                <div class="card-body">

                    <h5 class="card-title">
                        {{ $viewData['product']->getName() }} -
                        {{ $viewData['product']->getBrand() }}
                        @if ($viewData['product']->getFeatured())
                            <span class="badge bg-warning text-dark">{{ __('product.featuredBadge') }}</span>
                        @endif
                    </h5>

                    <div class="mb-2">
                        @for ($star = 1; $star <= 5; $star++)
                            @if ($star <= round($viewData['product']->getAverageRating()))
                                <i class="bi bi-star-fill text-warning"></i>
                            @else
                                <i class="bi bi-star text-warning"></i>
                            @endif
                        @endfor
                    </div>

                    <em>{{ __('product.labelCategory') }}:</em>
                    <p class="card-text">
                        {{ $viewData['product']->getCategory()->getName() }}
                    </p>

                    <em>{{ __('product.labelPrice') }}:</em>
                    <p class="card-text">
                        {{ $viewData['product']->getPrice() }}
                    </p>

                    <em>{{ __('product.labelDescription') }}:</em>
                    <p class="card-text">
                        {{ $viewData['product']->getDescription() }}
                    </p>

                    <em>{{ __('product.labelStock') }}:</em>
                    <p class="card-text">
                        {{ $viewData['product']->getStock() }}
                    </p>

                    @auth
                        @if ($viewData['product']->getStock() > 0)
                            <form action="{{ route('cart.add', ['id' => $viewData['product']->getId()]) }}" method="POST" class="d-flex align-items-end gap-2">
                                @csrf
                                <div>
                                    <label for="quantity" class="form-label">{{ __('product.labelQuantity') }}</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="{{ $viewData['product']->getStock() }}" style="width: 90px;">
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('product.addToCart') }}</button>
                            </form>
                        @else
                            <p class="text-danger">{{ __('product.outOfStock') }}</p>
                        @endif
                    @endauth

                    @if (auth()->user()?->getRole() === 'admin')
                        <form action="{{ route('product.delete', ['id' => $viewData['product']->getId()]) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('admin.delete') }}</button>
                        </form>
                    @endif

                </div>
            </div>

        </div>
    </div>

    <div class="card mb-5">
        <div class="card-body">
            <h4 class="card-title mb-3">{{ __('review.heading') }}</h4>

            @auth
                <form action="{{ route('review.store', ['id' => $viewData['product']->getId()]) }}" method="POST" class="mb-4">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label d-block">{{ __('review.labelRating') }}</label>
                        <div class="star-rating" id="starRating">
                            <button type="button" class="star-btn" data-value="1"><i class="bi bi-star"></i></button>
                            <button type="button" class="star-btn" data-value="2"><i class="bi bi-star"></i></button>
                            <button type="button" class="star-btn" data-value="3"><i class="bi bi-star"></i></button>
                            <button type="button" class="star-btn" data-value="4"><i class="bi bi-star"></i></button>
                            <button type="button" class="star-btn" data-value="5"><i class="bi bi-star"></i></button>
                        </div>
                        <input type="hidden" id="ratingInput" name="rating" value="5">
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">{{ __('review.labelComment') }}</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('review.submit') }}</button>
                </form>
            @else
                <p><a href="{{ route('login') }}">{{ __('review.loginToReview') }}</a></p>
            @endauth

            @forelse ($viewData['product']->getReviews() as $review)
                <div class="border-bottom py-2 d-flex justify-content-between align-items-start">
                    <div>
                        <strong>{{ $review->getUser()->getName() }}</strong>
                        &mdash; {{ $review->getRating() }}/5
                        <p class="mb-0">{{ $review->getComment() }}</p>
                    </div>
                    @if (auth()->check() && (auth()->user()->getId() === $review->getUserId() || auth()->user()->getRole() === 'admin'))
                        <form action="{{ route('review.delete', ['id' => $review->getId()]) }}" method="POST" onsubmit="return confirm('{{ __('review.confirmDelete') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger border-0" title="{{ __('review.deleteAction') }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    @endif
                </div>
            @empty
                <p class="text-muted">{{ __('review.noReviews') }}</p>
            @endforelse
        </div>
    </div>

</div>

<script src="{{ asset('js/star-rating.js') }}"></script>

@endsection
