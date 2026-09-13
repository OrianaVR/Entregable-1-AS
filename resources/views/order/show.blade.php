{{-- Author: Maria Laura Tafur Gómez --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')

<div class="profile-header text-center" style="padding-top: 60px; padding-bottom: 30px;">
    <h1 class="profile-title text-center mb-2" style="font-size: 42px;">Order #{{ $viewData['order']->getId() }}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center profile-breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('order.index') }}">My Orders</a></li>
            <li class="breadcrumb-item active" aria-current="page">#{{ $viewData['order']->getId() }}</li>
        </ol>
    </nav>
</div>

<div class="container-fluid px-3 py-4" style="max-width: 1000px;">
    <div class="profile-card">

        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <div>
                <span class="order-status-dot order-status-{{ $viewData['order']->getState() }}"></span>
                <span class="fw-semibold">{{ ucfirst(str_replace('inProcess', 'in process', $viewData['order']->getState())) }}</span>
            </div>
            <div class="text-muted small">
                Delivery Date: <span class="fw-medium text-dark">{{ $viewData['order']->getDeliveryDate() }}</span>
            </div>
            <a href="{{ route('order.index') }}" class="btn btn-outline-secondary btn-sm">Back to My Orders</a>
        </div>

        <div class="order-item-row mb-2">
            <div class="order-item-thumb">
                <i class="bi bi-geo-alt"></i>
            </div>
            <div class="order-item-name">Delivery Address: {{ $viewData['order']->getAddress() }}</div>
        </div>

    </div>
</div>
@endsection