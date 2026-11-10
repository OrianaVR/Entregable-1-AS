{{-- Author: Oriana --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container pt-4">
    @include('partials.breadcrumb', [
        'crumbs' => [
            ['label' => __('layout.navHome'), 'url' => route('home.index')],
            ['label' => $viewData['title']],
        ],
    ])
</div>


<div class="container py-5 hero-content">
    <h1>
        {{ $viewData['title'] }}
        <br>
        <em>{{ $viewData['subtitle'] }}</em>
    </h1>
</div>

<div class="container">
    @if ($viewData['error'] !== null)
        <div class="alert alert-danger text-center" role="alert">{{ $viewData['error'] }}</div>
    @endif

    <div class="row">
        @forelse ($viewData['products'] as $product)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card lume-card h-100">
                    <div class="position-relative">
                        @if ($product['image'] !== null)
                            <img src="{{ $product['image'] }}"
                                 class="img-card card-img-top"
                                 alt="{{ $product['name'] }}">
                        @endif

                        @if ($product['hasOffer'])
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">{{ __('team7.offerBadge') }}</span>
                        @endif
                    </div>

                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            @if ($product['brand'] !== null)
                                <p class="card-text mb-1 text-muted">{{ $product['brand'] }}</p>
                            @endif
                            <h5 class="card-title mb-2 text-dark">{{ $product['name'] }}</h5>
                            @if ($product['category'] !== null)
                                <p class="card-text mb-2 text-muted small">{{ __('team7.labelCategory') }}: {{ $product['category'] }}</p>
                            @endif
                            @if ($product['description'] !== null)
                                <p class="card-text mb-3 text-muted small">{{ \Illuminate\Support\Str::limit($product['description'], 90) }}</p>
                            @endif
                            @if ($product['hasOffer'])
                                <p class="card-text fw-bold mb-3 fs-5">
                                    <del class="text-muted fs-6 fw-normal">${{ number_format($product['price'], 2) }}</del>
                                    ${{ number_format($product['offerPrice'], 2) }}
                                    {{ $product['currency'] }}
                                </p>
                            @else
                                <p class="card-text fw-bold mb-3 fs-5">${{ number_format($product['price'], 2) }} {{ $product['currency'] }}</p>
                            @endif
                        </div>
                        @if ($product['url'] !== null)
                            <a href="{{ $product['url'] }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn btn-primary w-100">{{ __('team7.viewInStore') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            @if ($viewData['error'] === null)
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">{{ __('team7.noProducts') }}</p>
                </div>
            @endif
        @endforelse
    </div>
</div>

@endsection