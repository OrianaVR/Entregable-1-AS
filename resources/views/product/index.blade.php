@extends('layouts.app')
@section('content')

<div class="container py-5 hero-content">
    <h1>
        {{ $viewData['title'] }}
        <br>
        <em>{{ $viewData['subtitle'] }}</em>
    </h1>
</div>

<!-- Search Section -->
<div class="container mb-5">
    <form action="{{ route('product.index') }}" method="GET" class="d-flex justify-content-center">
        <div class="d-flex gap-2 w-100" style="max-width: 600px;">
            <input type="text" 
                   name="search" 
                   class="form-control lume-input w-100" 
                   placeholder="{{ __('product.searchPlaceholder') }}" 
                   value="{{ $viewData['searchTerm'] }}">
            
            <button type="submit" class="btn btn-primary px-4 fw-semibold">
                {{ __('product.searchAction') }}
            </button>
            
            @if ($viewData['searchTerm'] !== '')
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary px-4 fw-semibold">
                    {{ __('product.clearAction') }}
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Products Grid -->
<div class="container">
    <div class="row">

        @forelse ($viewData['products'] as $product)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card lume-card h-100">
                    <div class="position-relative">
                        <img src="{{ asset('images/products/'.$product->getImage()) }}"
                             class="img-card card-img-top"
                             alt="{{ $product->getName() }}">

                        @if ($product->getFeatured())
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">{{ __('product.featuredBadge') }}</span>
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
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">{{ __('product.noResults') }}</p>
                @if ($viewData['searchTerm'] !== '')
                    <a href="{{ route('product.index') }}" class="btn btn-primary mt-2">{{ __('product.backToCatalog') }}</a>
                @endif
            </div>
        @endforelse

    </div>
</div>

@endsection