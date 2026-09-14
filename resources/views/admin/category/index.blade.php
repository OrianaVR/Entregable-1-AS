@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
<div class="lume-container pt-3">

    <div class="row mb-4">
        <div class="col-auto">
            <div class="card border-0 shadow-sm rounded-3 px-4 py-3 bg-white" style="min-width: 220px;">
                <div class="text-muted fw-semibold small mb-1 text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">{{ __('category.statCurrentCategories') }}</div>
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-2 text-white d-flex align-items-center justify-content-center" style="background-color: var(--coral); width: 38px; height: 38px; font-size: 18px;">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                    <span class="fs-3 fw-bold text-dark">{{ count($viewData['categories']) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="lume-page-title m-0">{{ __('category.pageTitle') }}</h2>

        <a href="{{ route('admin.category.create') }}" class="btn btn-primary px-3 py-2 fw-semibold">
            <i class="bi bi-plus-lg me-1"></i> {{ __('category.createCategory') }}
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-3 bg-white overflow-hidden mb-4">

        <div class="table-responsive">
            <table class="table lume-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>{{ __('category.tableId') }}</th>
                        <th>{{ __('category.tableName') }}</th>
                        <th>{{ __('category.tableDescription') }}</th>
                        <th class="text-center">{{ __('category.tableProducts') }}</th>
                        <th class="text-end pe-4">{{ __('category.tableActions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($viewData['categories'] as $category)
                        <tr>
                            <td>
                                <a href="{{ route('admin.category.edit', ['id' => $category->getId()]) }}" class="lume-id-link">
                                    {{ $category->getId() }}
                                </a>
                            </td>
                            <td class="fw-medium text-dark">
                                {{ $category->getName() }}
                            </td>
                            <td class="text-muted">
                                {{ $category->getDescription() }}
                            </td>
                            <td class="text-center">
                                {{ $category->getProductsCount() }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="lume-actions-group">
                                    <a href="{{ route('admin.category.edit', ['id' => $category->getId()]) }}" class="lume-action-icon" title="{{ __('category.editAction') }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.category.delete', ['id' => $category->getId()]) }}" method="POST" onsubmit="return confirm('{{ __('category.confirmDelete') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="lume-action-icon text-danger border-0 bg-transparent p-0" title="{{ __('category.deleteAction') }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                {{ __('category.noCategoriesFound') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
