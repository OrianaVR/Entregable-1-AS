@extends('layouts.app') 

@section('content') 

<header class="lume-hero">
    <div class="hero-content">
        <h1>
            {{ $viewData['title'] }}
            <br>
            <em>{{ $viewData['subtitle'] }}</em>
        </h1>
    </div>
</header>

<div class="container py-5">
    <hr class="mb-5 mx-auto" style="border-top: 2px solid var(--coral, #f4a2a1); opacity: 0.4; max-width: 80%;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="lume-page-title m-0">{{ __('home.routineTitle') }}</h2>
            <p class="text-muted mb-0">{{ __('home.routineSubtitle') }}</p>
        </div>
    </div>

    @foreach ($viewData['routineCategories'] as $index => $category)
        <div class="mb-5">
            <div class="d-flex align-items-center mb-2">
                <span class="rounded-circle me-3 fs-6 d-flex align-items-center justify-content-center fw-bold text-white shadow-sm" 
                      style="width: 38px; height: 38px; background-color: var(--coral, #f4a2a1);">
                    {{ $index + 1 }}
                </span>
                <h3 class="h4 mb-0 fw-bold text-dark">{{ $category->getName() }}</h3>
            </div>
            <p class="text-muted ms-5 mb-4">{{ $category->getDescription() }}</p>

            <div class="row ms-4">
                @forelse ($category->products as $product)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card lume-card h-100">
                            <div class="position-relative">
                                <img src="{{ asset('images/products/' . $product->getImage()) }}"
                                     class="img-card card-img-top"
                                     alt="{{ $product->getName() }}">

                                @if ($product->getFeatured())
                                    <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">
                                        {{ __('product.featuredBadge') }}
                                    </span>
                                @endif
                            </div>

                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <div>
                                    <p class="card-text mb-1 text-muted">{{ $product->getBrand() }}</p>
                                    <h5 class="card-title mb-2 text-dark">{{ $product->getName() }}</h5>
                                    <p class="card-text fw-bold mb-3 fs-5">${{ number_format($product->getPrice(), 2) }}</p>
                                </div>
                                <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
                                   class="btn btn-primary w-100">{{ __('product.viewAction') }}</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted fst-italic">{{ __('home.noProducts') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endforeach
</div>

@endsection