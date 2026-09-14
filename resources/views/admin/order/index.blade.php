@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
<div class="lume-container pt-3">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-4">
        <div class="col-auto">
            <div class="card border-0 shadow-sm rounded-3 px-4 py-3 bg-white" style="min-width: 220px;">
                <div class="text-muted fw-semibold small mb-1 text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">{{ __('payment.pageTitle') }}</div>
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-2 text-white d-flex align-items-center justify-content-center" style="background-color: var(--coral); width: 38px; height: 38px; font-size: 18px;">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <span class="fs-3 fw-bold text-dark">{{ count($viewData['orders']) }}</span>
                </div>
            </div>
        </div>
    </div>

    <h2 class="lume-page-title mb-3">{{ __('payment.pageTitle') }}</h2>

    <div class="card border-0 shadow-sm rounded-3 bg-white overflow-hidden mb-4">

        <div class="table-responsive">
            <table class="table lume-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>{{ __('payment.tableId') }}</th>
                        <th>{{ __('payment.tableCustomer') }}</th>
                        <th>{{ __('payment.tableState') }}</th>
                        <th>{{ __('payment.tablePaymentStatus') }}</th>
                        <th class="text-end pe-4">{{ __('payment.tableActions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($viewData['orders'] as $order)
                        <tr>
                            <td>
                                <a href="{{ route('order.show', ['id' => $order->getId()]) }}" class="lume-id-link">
                                    #{{ $order->getId() }}
                                </a>
                            </td>
                            <td class="text-muted">
                                {{ $order->getUser()->getName() }}
                            </td>
                            <td>
                                <span class="order-status-dot order-status-{{ $order->getState() }}"></span>
                                {{ __('order.status'.ucfirst($order->getState())) }}
                            </td>
                            <td>
                                @if ($order->getPayment() !== null)
                                    {{ __('payment.status'.ucfirst($order->getPayment()->getStatus())) }}
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('order.show', ['id' => $order->getId()]) }}" class="lume-action-icon" title="{{ __('payment.viewAction') }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                {{ __('payment.noOrdersFound') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
