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
                <div class="text-muted fw-semibold small mb-1 text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">{{ __('product.statCurrentProducts') }}</div>
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-2 text-white d-flex align-items-center justify-content-center" style="background-color: var(--coral); width: 38px; height: 38px; font-size: 18px;">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                    <span class="fs-3 fw-bold text-dark">{{ count($viewData['products']) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="lume-page-title m-0">{{ __('product.pageTitle') }}</h2>

        <a href="{{ route('product.create') }}" class="btn btn-primary px-3 py-2 fw-semibold">
            <i class="bi bi-plus-lg me-1"></i> {{ __('product.createProduct') }}
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-3 bg-white overflow-hidden mb-4">

        <div class="table-responsive">
            <table class="table lume-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>{{ __('product.tableImage') }}</th>
                        <th>{{ __('product.tableName') }}</th>
                        <th>{{ __('product.tableBrand') }}</th>
                        <th>{{ __('product.tableCategory') }}</th>
                        <th class="text-end">{{ __('product.tablePrice') }}</th>
                        <th class="text-end">{{ __('product.tableStock') }}</th>
                        <th class="text-end pe-4">{{ __('product.tableActions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($viewData['products'] as $product)
                        <tr>
                            <td>
                                <img src="{{ asset('images/products/'.$product->getImage()) }}" alt="{{ $product->getName() }}" style="width: 44px; height: 44px; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td class="fw-medium text-dark">
                                <a href="{{ route('product.edit', ['id' => $product->getId()]) }}" class="lume-id-link text-decoration-none">
                                    {{ $product->getName() }}
                                </a>
                            </td>
                            <td class="text-muted">
                                {{ $product->getBrand() }}
                            </td>
                            <td class="text-muted">
                                {{ $product->getCategory()->getName() }}
                            </td>
                            <td class="text-end">
                                {{ number_format($product->getPrice(), 2) }}
                            </td>
                            <td class="text-end">
                                {{ $product->getStock() }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="lume-actions-group">
                                    <a href="{{ route('product.show', ['id' => $product->getId()]) }}" class="lume-action-icon" title="{{ __('product.viewAction') }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('product.edit', ['id' => $product->getId()]) }}" class="lume-action-icon" title="{{ __('product.editAction') }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('product.delete', ['id' => $product->getId()]) }}" method="POST" onsubmit="return confirm('{{ __('product.confirmDelete') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="lume-action-icon text-danger border-0 bg-transparent p-0" title="{{ __('product.deleteAction') }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                {{ __('product.noProductsFound') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
