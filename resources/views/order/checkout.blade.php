{{-- Author: Ana Sofía Angarita Barrios --}}
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

<div class="container py-5">
    <h1 class="mb-4">{{ $viewData['title'] }}</h1>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ __('form.reviewErrors') }}
        </div>
    @endif

    @if (empty($viewData['cartItems']))
        <p>{{ __('order.cartEmptyMessage') }}</p>
        <a href="{{ route('product.index') }}" class="btn btn-primary">{{ __('order.browseProducts') }}</a>
    @else
        <div class="table-responsive mb-4">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>{{ __('order.colProduct') }}</th>
                        <th>{{ __('order.colQuantity') }}</th>
                        <th>{{ __('order.colSubtotal') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewData['cartItems'] as $cartItem)
                        <tr>
                            <td>{{ $cartItem['product']->getName() }}</td>
                            <td>{{ $cartItem['quantity'] }}</td>
                            <td>{{ number_format($cartItem['subtotal'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', ['id' => $cartItem['product']->getId()]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('order.remove') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">{{ __('order.total') }}</th>
                        <th>{{ number_format($viewData['total'], 2) }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <h4 class="mb-3">{{ __('order.deliveryDetails') }}</h4>

        <form action="{{ route('order.store') }}" method="POST" novalidate data-live-validate>
            @csrf

            <div class="mb-3">
                <label for="address" class="form-label">{{ __('auth.labelAddress') }}</label>
                <input type="text" class="form-control lume-input @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $viewData['address']) }}" required>
                @include('partials.fieldError', ['field' => 'address'])
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('order.colDeliveryDate') }}</label>
                <input type="text" class="form-control" value="{{ $viewData['deliveryDate'] }}" readonly>
                <div class="form-text">{{ __('order.deliveryDateNotice', ['days' => $viewData['deliveryDays']]) }}</div>
            </div>

            <div class="mb-3">
                <label for="payment_method" class="form-label">{{ __('order.labelPaymentMethod') }}</label>
                <select class="form-select lume-input @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                    <option value="card" {{ old('payment_method') === 'card' ? 'selected' : '' }}>{{ __('order.paymentMethodCard') }}</option>
                    <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>{{ __('order.paymentMethodCash') }}</option>
                </select>
                @include('partials.fieldError', ['field' => 'payment_method'])
            </div>

            <button type="submit" class="btn btn-primary">{{ __('order.placeOrder') }}</button>
        </form>
    @endif
</div>
@endsection