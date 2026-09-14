{{-- Author: Maria Laura Tafur Gómez --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')

<div class="profile-header text-center" style="padding-top: 60px; padding-bottom: 30px;">
    <h1 class="profile-title text-center mb-2" style="font-size: 42px;">{{ __('order.orderHeading', ['id' => $viewData['order']->getId()]) }}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center profile-breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('layout.navHome') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('order.index') }}">{{ __('order.pageTitle') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">#{{ $viewData['order']->getId() }}</li>
        </ol>
    </nav>
</div>

<div class="container-fluid px-3 py-4" style="max-width: 1000px;">
    <div class="profile-card">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <div>
                <span class="order-status-dot order-status-{{ $viewData['order']->getState() }}"></span>
                <span class="fw-semibold">{{ __('order.status'.ucfirst($viewData['order']->getState())) }}</span>
            </div>
            <div class="text-muted small">
                {{ __('order.deliveryDateLabel') }}: <span class="fw-medium text-dark">{{ $viewData['order']->getDeliveryDate() }}</span>
            </div>
            <a href="{{ route('order.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('order.backToOrders') }}</a>
        </div>

        @if (auth()->user()->getRole() === 'admin')
            <div class="order-item-row mb-2">
                <div class="order-item-thumb">
                    <i class="bi bi-person"></i>
                </div>
                <div class="order-item-name">{{ $viewData['order']->getUser()->getName() }} — {{ $viewData['order']->getUser()->getEmail() }}</div>
            </div>
        @endif

        <div class="order-item-row mb-2">
            <div class="order-item-thumb">
                <i class="bi bi-geo-alt"></i>
            </div>
            <div class="order-item-name">{{ __('order.deliveryAddress') }}: {{ $viewData['order']->getAddress() }}</div>
        </div>

        <h5 class="fw-semibold mt-4 mb-3">{{ __('order.itemsHeading') }}</h5>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>{{ __('order.colProduct') }}</th>
                        <th class="text-end">{{ __('order.colQuantity') }}</th>
                        <th class="text-end">{{ __('order.colUnitPrice') }}</th>
                        <th class="text-end">{{ __('order.colSubtotal') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewData['order']->getItems() as $item)
                        <tr>
                            <td>
                                <a href="{{ route('product.show', ['id' => $item->getProduct()->getId()]) }}">
                                    {{ $item->getProduct()->getName() }}
                                </a>
                            </td>
                            <td class="text-end">{{ $item->getQuantity() }}</td>
                            <td class="text-end">{{ number_format($item->getPrice(), 2) }}</td>
                            <td class="text-end">{{ number_format($item->getPrice() * $item->getQuantity(), 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">{{ __('order.total') }}</th>
                        <th class="text-end">{{ number_format($viewData['total'], 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if ($viewData['order']->getPayment() !== null)
            <h5 class="fw-semibold mt-4 mb-3">{{ __('payment.heading') }}</h5>

            <div class="order-item-row mb-2">
                <div class="order-item-thumb">
                    <i class="bi bi-credit-card"></i>
                </div>
                <div class="order-item-name">
                    {{ __('payment.labelMethod') }}: {{ $viewData['order']->getPayment()->getMethod() }}<br>
                    {{ __('payment.labelStatus') }}:
                    <span class="fw-semibold">{{ __('payment.status'.ucfirst($viewData['order']->getPayment()->getStatus())) }}</span><br>
                    {{ __('payment.labelTransactionCode') }}: {{ $viewData['order']->getPayment()->getTransactionCode() }}
                </div>
            </div>

            @if (auth()->user()->getRole() === 'admin' && $viewData['order']->getPayment()->getStatus() === 'pending')
                <div class="d-flex gap-2 mt-2">
                    <form action="{{ route('payment.confirm', ['id' => $viewData['order']->getId()]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">{{ __('payment.confirmPayment') }}</button>
                    </form>
                    <form action="{{ route('payment.reject', ['id' => $viewData['order']->getId()]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('payment.rejectPayment') }}</button>
                    </form>
                </div>
            @endif
        @endif

        <a href="{{ route('payment.receipt', ['id' => $viewData['order']->getId()]) }}" class="btn btn-outline-primary mt-3">
            <i class="bi bi-file-earmark-pdf me-1"></i>{{ __('order.downloadReceipt') }}
        </a>

    </div>
</div>
@endsection