{{-- Author: Maria Laura Tafur Gómez, Ana Sofía Angarita Barrios --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')

<div class="container lume-product-page">

    <a href="{{ route('product.index') }}" class="lume-back-link">
        <i class="bi bi-arrow-left"></i> {{ __('product.backToCatalog') }}
    </a>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <div class="row g-5 mt-1">

        <div class="col-md-6">
            <div class="lume-product-gallery">
                @if ($viewData['product']->getFeatured())
                    <span class="lume-product-badge">{{ __('product.featuredBadge') }}</span>
                @endif
                <img src="{{ asset('images/products/'.$viewData['product']->getImage()) }}"
                     alt="{{ $viewData['product']->getName() }}">
            </div>
        </div>

        <div class="col-md-6">
            <p class="lume-product-brand">{{ $viewData['product']->getBrand() }}</p>
            <h1 class="lume-product-name">{{ $viewData['product']->getName() }}</h1>

            <div class="lume-product-rating">
                @for ($star = 1; $star <= 5; $star++)
                    @if ($star <= round($viewData['product']->getAverageRating()))
                        <i class="bi bi-star-fill"></i>
                    @else
                        <i class="bi bi-star"></i>
                    @endif
                @endfor
                <a href="#reviews" class="lume-product-rating-count">
                    {{ trans_choice('review.count', count($viewData['product']->getReviews()), ['count' => count($viewData['product']->getReviews())]) }}
                </a>
            </div>

            <p class="lume-product-price">{{ $viewData['currencyPrice'] }}</p>

            <div class="lume-product-section">
                <span class="lume-label">{{ __('product.labelDescription') }}</span>
                <p class="lume-product-text">{{ $viewData['product']->getDescription() }}</p>
            </div>

            <div class="lume-product-details">
                <div>
                    <span class="lume-label">{{ __('product.labelCategory') }}</span>
                    <p class="lume-product-text mb-0">{{ $viewData['product']->getCategory()->getName() }}</p>
                </div>
                <div>
                    <span class="lume-label">{{ __('product.labelStock') }}</span>
                    @if ($viewData['product']->getStock() > 0)
                        <p class="mb-0"><span class="lume-stock-pill">{{ __('product.inStock', ['count' => $viewData['product']->getStock()]) }}</span></p>
                    @else
                        <p class="mb-0"><span class="lume-stock-pill lume-stock-pill-out">{{ __('product.outOfStock') }}</span></p>
                    @endif
                </div>
            </div>

            @auth
                @if ($viewData['product']->getStock() > 0)
                    <form action="{{ route('cart.add', ['id' => $viewData['product']->getId()]) }}" method="POST" class="lume-buy-box">
                        @csrf
                        <div>
                            <label for="quantity" class="lume-label">{{ __('product.labelQuantity') }}</label>
                            <input type="number" class="form-control lume-qty-input" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="{{ $viewData['product']->getStock() }}">
                        </div>
                        <button type="submit" class="btn lume-btn-dark flex-grow-1">
                            <i class="bi bi-bag me-2"></i>{{ __('product.addToCart') }}
                        </button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn lume-btn-dark w-100 mt-4">{{ __('product.loginToBuy') }}</a>
            @endauth

            <ul class="lume-perks">
                <li><i class="bi bi-patch-check"></i>{{ __('product.perkAuthentic') }}</li>
                <li><i class="bi bi-shield-lock"></i>{{ __('product.perkSecure') }}</li>
                <li><i class="bi bi-truck"></i>{{ __('product.perkDelivery') }}</li>
            </ul>

            @if (auth()->user()?->getRole() === 'admin')
                <form action="{{ route('admin.product.delete', ['id' => $viewData['product']->getId()]) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash me-1"></i>{{ __('admin.delete') }}
                    </button>
                </form>
            @endif
        </div>

    </div>

    <section id="reviews" class="lume-reviews">
        <div class="lume-reviews-header">
            <h2 class="lume-section-title">{{ __('review.heading') }}</h2>
            <span class="lume-reviews-summary">
                <i class="bi bi-star-fill"></i>
                {{ number_format($viewData['product']->getAverageRating(), 1) }}
                &middot;
                {{ trans_choice('review.count', count($viewData['product']->getReviews()), ['count' => count($viewData['product']->getReviews())]) }}
            </span>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="lume-review-form">
                    <h3 class="lume-review-form-title">{{ __('review.writeHeading') }}</h3>

                    @auth
                        <form action="{{ route('review.store', ['id' => $viewData['product']->getId()]) }}" method="POST">
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
                                <span class="lume-label d-block">{{ __('review.labelRating') }}</span>
                                <div class="star-rating" id="starRating">
                                    <button type="button" class="star-btn" data-value="1"><i class="bi bi-star"></i></button>
                                    <button type="button" class="star-btn" data-value="2"><i class="bi bi-star"></i></button>
                                    <button type="button" class="star-btn" data-value="3"><i class="bi bi-star"></i></button>
                                    <button type="button" class="star-btn" data-value="4"><i class="bi bi-star"></i></button>
                                    <button type="button" class="star-btn" data-value="5"><i class="bi bi-star"></i></button>
                                </div>
                                <input type="hidden" id="ratingInput" name="rating" value="{{ old('rating', 5) }}">
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="lume-label">{{ __('review.labelComment') }}</label>
                                <textarea class="form-control lume-textarea" id="comment" name="comment" rows="4" placeholder="{{ __('review.commentPlaceholder') }}">{{ old('comment') }}</textarea>
                            </div>

                            <button type="submit" class="btn lume-btn-dark w-100">{{ __('review.submit') }}</button>
                        </form>
                    @else
                        <p class="lume-product-text">{{ __('review.loginHint') }}</p>
                        <a href="{{ route('login') }}" class="btn lume-btn-outline w-100">{{ __('review.loginToReview') }}</a>
                    @endauth
                </div>
            </div>

            <div class="col-lg-8">
                @forelse ($viewData['product']->getReviews() as $review)
                    <article class="lume-review-card">
                        <div class="lume-review-avatar">{{ mb_strtoupper(mb_substr($review->getUser()->getName(), 0, 1)) }}</div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="lume-review-author">{{ $review->getUser()->getName() }}</p>
                                    <div class="lume-review-stars">
                                        @for ($star = 1; $star <= 5; $star++)
                                            @if ($star <= $review->getRating())
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                @if (auth()->check() && (auth()->user()->getId() === $review->getUserId() || auth()->user()->getRole() === 'admin'))
                                    <form action="{{ route('review.delete', ['id' => $review->getId()]) }}" method="POST" data-confirm-delete="{{ __('review.confirmDelete') }}" onsubmit="return confirm(this.dataset.confirmDelete);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0" title="{{ __('review.deleteAction') }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <p class="lume-review-comment">{{ $review->getComment() }}</p>
                        </div>
                    </article>
                @empty
                    <div class="lume-review-empty">
                        <i class="bi bi-chat-heart"></i>
                        <p class="mb-0">{{ __('review.noReviews') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</div>

<script src="{{ asset('js/star-rating.js') }}"></script>

@endsection
