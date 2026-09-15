@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
<div class="lume-container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}" class="text-decoration-none">{{ __('product.pageTitle') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('product.breadcrumbEditProduct', ['id' => $viewData['product']->getId()]) }}</li>
                </ol>
            </nav>
            <h2 class="lume-page-title m-0">{{ __('product.editProductHeading', ['name' => $viewData['product']->getName()]) }}</h2>
        </div>

        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
            {{ __('admin.cancel') }}
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="lume-card p-4">
        <form action="{{ route('product.update', ['id' => $viewData['product']->getId()]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label fw-semibold">{{ __('product.labelName') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input" id="name" name="name" value="{{ old('name', $viewData['product']->getName()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="brand" class="form-label fw-semibold">{{ __('product.labelBrand') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input" id="brand" name="brand" value="{{ old('brand', $viewData['product']->getBrand()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="price" class="form-label fw-semibold">{{ __('product.labelPrice') }} <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" min="0.01" class="form-control lume-input" id="price" name="price" value="{{ old('price', $viewData['product']->getPrice()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="stock" class="form-label fw-semibold">{{ __('product.labelStock') }} <span class="text-danger">*</span></label>
                    <input type="number" min="0" class="form-control lume-input" id="stock" name="stock" value="{{ old('stock', $viewData['product']->getStock()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="category_id" class="form-label fw-semibold">{{ __('product.labelCategory') }} <span class="text-danger">*</span></label>
                    <select class="form-select lume-input" id="category_id" name="category_id" required>
                        @foreach ($viewData['categories'] as $category)
                            <option value="{{ $category->getId() }}" {{ old('category_id', $viewData['product']->getCategoryId()) == $category->getId() ? 'selected' : '' }}>
                                {{ $category->getName() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label for="image" class="form-label fw-semibold">{{ __('product.labelImage') }} <small class="text-muted">{{ __('product.imageEditHint') }}</small></label>
                    <input type="file" class="form-control lume-input" id="image" name="image" accept="image/*">
                </div>

                <div class="col-12">
                    <label for="description" class="form-label fw-semibold">{{ __('product.labelDescription') }} <span class="text-danger">*</span></label>
                    <textarea class="form-control lume-input" id="description" name="description" rows="3" required>{{ old('description', $viewData['product']->getDescription()) }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">{{ __('admin.cancel') }}</a>
                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">{{ __('product.updateProduct') }}</button>
            </div>
        </form>
    </div>

</div>
@endsection
