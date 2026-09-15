@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $viewData['title'] }}</h1>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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

        <form action="{{ route('order.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="address" class="form-label">{{ __('auth.labelAddress') }}</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
            </div>

            <div class="mb-3">
                <label for="delivery_date" class="form-label">{{ __('order.colDeliveryDate') }}</label>
                <input type="date" class="form-control" id="delivery_date" name="delivery_date" value="{{ old('delivery_date') }}" required>
            </div>

            <div class="mb-3">
                <label for="payment_method" class="form-label">{{ __('order.labelPaymentMethod') }}</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="card">{{ __('order.paymentMethodCard') }}</option>
                    <option value="cash">{{ __('order.paymentMethodCash') }}</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('order.placeOrder') }}</button>
        </form>
    @endif
</div>
@endsection
