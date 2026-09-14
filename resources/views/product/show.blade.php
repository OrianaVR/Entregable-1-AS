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
                    </h5>

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
                        <label for="rating" class="form-label">{{ __('review.labelRating') }}</label>
                        <select class="form-select" id="rating" name="rating" style="max-width: 120px;">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
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

@endsection
