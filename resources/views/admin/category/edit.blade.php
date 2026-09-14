@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
<div class="lume-container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}" class="text-decoration-none">{{ __('category.pageTitle') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('category.breadcrumbEditCategory', ['id' => $viewData['category']->getId()]) }}</li>
                </ol>
            </nav>
            <h2 class="lume-page-title m-0">{{ __('category.editCategoryHeading', ['name' => $viewData['category']->getName()]) }}</h2>
        </div>

        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">
            {{ __('category.cancel') }}
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
        <form action="{{ route('admin.category.update', ['id' => $viewData['category']->getId()]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label fw-semibold">{{ __('category.labelName') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input" id="name" name="name" value="{{ old('name', $viewData['category']->getName()) }}" required>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label fw-semibold">{{ __('category.labelDescription') }} <span class="text-danger">*</span></label>
                    <textarea class="form-control lume-input" id="description" name="description" rows="3" required>{{ old('description', $viewData['category']->getDescription()) }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">{{ __('category.cancel') }}</a>
                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">{{ __('category.updateCategory') }}</button>
            </div>
        </form>
    </div>

</div>
@endsection
