@extends('layouts.app')
@section('content')

<div class="container py-5 hero-content">
    <h1>
        {{ $viewData['title'] }}
        <br>
        <em>{{ $viewData['subtitle'] }}</em>
    </h1>
</div>

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

                <em>Category:</em>
                <p class="card-text">
                    {{ $viewData['product']->getCategory()->getName() }}
                </p>

                <em>Price:</em>
                <p class="card-text">
                    {{ $viewData['product']->getPrice() }}
                </p>

                <em>Description:</em>
                <p class="card-text">
                    {{ $viewData['product']->getDescription() }}
                </p>

                <em>Stock:</em>
                <p class="card-text">
                    {{ $viewData['product']->getStock() }}
                </p>

                <form action="{{ route('product.delete', ['id' => $viewData['product']->getId()]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection
