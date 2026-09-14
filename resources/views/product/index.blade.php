@extends('layouts.app')
@section('content')

<div class="container py-5 hero-content">
    <h1>
        {{ $viewData['title'] }}
        <br>
        <em>{{ $viewData['subtitle'] }}</em>
    </h1>
</div>

<div class="row">

    @forelse ($viewData['products'] as $product)

        <div class="col-md-4 col-lg-3 mb-2">
            <div class="card">

                <img src="{{ asset('images/products/'.$product->getImage()) }}"
                     class="img-fluid rounded-start"
                     alt="{{ $product->getName() }}">

                <div class="card-body text-center">
                    <p class="card-text mb-1">{{ $product->getName() }} - {{ $product->getBrand() }}</p>
                    <p class="card-text fw-semibold mb-2">{{ number_format($product->getPrice(), 2) }}</p>
                    <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
                       class="btn btn-primary">{{ __('product.viewAction') }}</a>
                </div>

            </div>
        </div>

    @empty

        <div class="col-12">
            <p class="text-muted">{{ __('product.noResults') }}</p>
        </div>

    @endforelse

</div>

@endsection
