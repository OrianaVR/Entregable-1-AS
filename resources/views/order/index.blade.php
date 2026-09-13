{{-- Author: Maria Laura Tafur Gómez --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="profile-page-wrapper">

    <div class="profile-header text-center" style="padding-top: 60px; padding-bottom: 30px;">
        <h1 class="profile-title text-center mb-2" style="font-size: 42px;">My Orders</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center profile-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid px-3 py-4" style="max-width: 1380px;">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5">

            <div class="col-12 col-md-4 col-lg-3">
                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('client.profile', ['id' => Auth::id()]) }}" class="btn btn-light border text-start py-3 px-4 rounded-3 text-dark fw-medium shadow-sm d-flex align-items-center justify-content-between" style="background-color: #ffffff;">
                        <span><i class="bi bi-person-fill me-2 text-muted"></i>Personal Information</span>
                        <i class="bi bi-chevron-right small text-muted"></i>
                    </a>

                    <a href="{{ route('order.index') }}" class="btn text-white fw-bold text-start py-3 px-4 rounded-3 shadow-sm d-flex align-items-center justify-content-between" style="background-color: #e5a93c; border-color: #e5a93c;">
                        <span><i class="bi bi-bag-fill me-2"></i>My Orders</span>
                        <i class="bi bi-chevron-right small"></i>
                    </a>

                    <a href="{{ route('home.index') }}" class="btn btn-outline-danger text-start py-3 px-4 rounded-3 fw-medium shadow-sm d-flex align-items-center justify-content-between" style="background-color: #ffffff;">
                        <span><i class="bi bi-box-arrow-right me-2"></i>Logout</span>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-8 ms-auto">
                <div class="profile-card p-0">

                    <div class="p-4 pb-0">
                        <h4 class="fw-semibold mb-4 text-dark">My orders</h4>

                        <div class="d-flex gap-2 flex-wrap mb-4 order-tabs">
                            <span class="order-tab order-tab-active px-4 py-2 rounded-pill border d-inline-block text-center fw-medium" data-status="all" style="cursor: pointer; background-color: #2b3a33; color: #ffffff; border-color: #2b3a33;">All ({{ count($viewData['orders']) }})</span>
                            <span class="order-tab px-4 py-2 rounded-pill border d-inline-block text-center fw-medium" data-status="inProcess" style="cursor: pointer; background-color: #ffffff; color: #2b3a33; border-color: #ced4da;">In process ({{ $viewData['inProcessCount'] }})</span>
                            <span class="order-tab px-4 py-2 rounded-pill border d-inline-block text-center fw-medium" data-status="completed" style="cursor: pointer; background-color: #ffffff; color: #2b3a33; border-color: #ced4da;">Completed ({{ $viewData['completedCount'] }})</span>
                            <span class="order-tab px-4 py-2 rounded-pill border d-inline-block text-center fw-medium" data-status="canceled" style="cursor: pointer; background-color: #ffffff; color: #2b3a33; border-color: #ced4da;">Canceled ({{ $viewData['canceledCount'] }})</span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table order-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Order number</th>
                                    <th>Cost</th>
                                    <th>Delivery date</th>
                                    <th>Order status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($viewData['orders'] as $order)
                                    <tr class="order-row" data-order-status="{{ $order->getState() }}" data-bs-toggle="collapse" data-bs-target="#orderDetail{{ $order->getId() }}" role="button">
                                        <td class="fw-semibold">
                                            <a href="{{ route('order.show', ['id' => $order->getId()]) }}" class="lume-id-link" onclick="event.stopPropagation()">
                                                #{{ $order->getId() }}
                                            </a>
                                        </td>
                                        <td>${{ number_format($order->getTotal(), 2) }}</td>
                                        <td>{{ $order->getDeliveryDate() }}</td>
                                        <td>
                                            <span class="order-status-dot order-status-{{ $order->getState() }}"></span>
                                            {{ ucfirst(str_replace('inProcess', 'in process', $order->getState())) }}
                                        </td>
                                        <td class="text-end"><i class="bi bi-chevron-down"></i></td>
                                    </tr>
                                    <tr class="collapse order-row-detail" data-order-status="{{ $order->getState() }}" id="orderDetail{{ $order->getId() }}">
                                        <td colspan="5" class="p-0">
                                            <div class="order-item-row">
                                                <div class="order-item-thumb">
                                                    <i class="bi bi-box-seam"></i>
                                                </div>
                                                <div class="order-item-name">{{ $order->getItemDescription() }}</div>
                                                <div class="order-item-qty">Quantity: {{ $order->getQuantity() }}</div>
                                                <div class="order-item-price">Price: ${{ number_format($order->getPrice(), 2) }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            You don't have any orders yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
