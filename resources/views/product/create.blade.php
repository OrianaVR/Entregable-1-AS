{{-- Author: Ana Sofía Angarita Barrios --}}
@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
<div class="lume-container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            @include('partials.breadcrumb', [
                'crumbs' => [
                    ['label' => __('product.pageTitle'), 'url' => route('admin.product.index')],
                    ['label' => __('product.createProduct')],
                ],
            ])
            <h2 class="lume-page-title m-0">{{ __('product.createProduct') }}</h2>
        </div>

        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
            {{ __('admin.cancel') }}
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ __('form.reviewErrors') }}
        </div>
    @endif

    <div class="lume-card p-4">
        <form action="{{ route('admin.product.save') }}" method="POST" enctype="multipart/form-data" novalidate data-live-validate>
            @csrf

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label fw-semibold">{{ __('product.labelName') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @include('partials.fieldError', ['field' => 'name'])
                </div>

                <div class="col-12 col-md-6">
                    <label for="brand" class="form-label fw-semibold">{{ __('product.labelBrand') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand') }}" required>
                    @include('partials.fieldError', ['field' => 'brand'])
                </div>

                <div class="col-12 col-md-6">
                    <label for="price" class="form-label fw-semibold">{{ __('product.labelPrice') }} <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" min="0.01" class="form-control lume-input @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                    @include('partials.fieldError', ['field' => 'price'])
                </div>

                <div class="col-12 col-md-6">
                    <label for="stock" class="form-label fw-semibold">{{ __('product.labelStock') }} <span class="text-danger">*</span></label>
                    <input type="number" min="0" class="form-control lume-input @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" required>
                    @include('partials.fieldError', ['field' => 'stock'])
                </div>

                <div class="col-12 col-md-6">
                    <label for="category_id" class="form-label fw-semibold">{{ __('product.labelCategory') }} <span class="text-danger">*</span></label>
                    <select class="form-select lume-input @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                        @foreach ($viewData['categories'] as $category)
                            <option value="{{ $category->getId() }}" {{ old('category_id') == $category->getId() ? 'selected' : '' }}>
                                {{ $category->getName() }}
                            </option>
                        @endforeach
                    </select>
                    @include('partials.fieldError', ['field' => 'category_id'])
                </div>

                <div class="col-12 col-md-6">
                    <label for="image" class="form-label fw-semibold">{{ __('product.labelImage') }} <span class="text-danger">*</span></label>
                    <input type="file" class="form-control lume-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" data-max-kb="2048" required>
                    @include('partials.fieldError', ['field' => 'image'])
                </div>

                <div class="col-12">
                    <label for="description" class="form-label fw-semibold">{{ __('product.labelDescription') }} <span class="text-danger">*</span></label>
                    <textarea class="form-control lume-input @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @include('partials.fieldError', ['field' => 'description'])
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">{{ __('admin.cancel') }}</a>
                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">{{ __('product.createProduct') }}</button>
            </div>
        </form>
    </div>

</div>
@endsection