@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
<div class="lume-container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}" class="text-decoration-none">{{ __('admin.pageTitleUsers') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('admin.breadcrumbEditUser', ['id' => $viewData['user']->getId()]) }}</li>
                </ol>
            </nav>
            <h2 class="lume-page-title m-0">{{ __('admin.editUserHeading', ['name' => $viewData['user']->getName()]) }}</h2>
        </div>

        <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
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
        <form action="{{ route('admin.user.update', ['id' => $viewData['user']->getId()]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label fw-semibold">{{ __('auth.labelName') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input" id="name" name="name" value="{{ old('name', $viewData['user']->getName()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="email" class="form-label fw-semibold">{{ __('auth.labelEmail') }} <span class="text-danger">*</span></label>
                    <input type="email" class="form-control lume-input" id="email" name="email" value="{{ old('email', $viewData['user']->getEmail()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="password" class="form-label fw-semibold">{{ __('auth.labelPassword') }} <small class="text-muted">{{ __('admin.passwordHint') }}</small></label>
                    <input type="password" class="form-control lume-input" id="password" name="password" placeholder="{{ __('admin.passwordPlaceholder') }}">
                </div>

                <div class="col-12 col-md-6">
                    <label for="role" class="form-label fw-semibold">{{ __('admin.labelRole') }} <span class="text-danger">*</span></label>
                    <select class="form-select lume-input" id="role" name="role" required>
                        <option value="user" {{ old('role', $viewData['user']->getRole()) === 'user' ? 'selected' : '' }}>{{ __('admin.roleUser') }}</option>
                        <option value="admin" {{ old('role', $viewData['user']->getRole()) === 'admin' ? 'selected' : '' }}>{{ __('admin.roleAdmin') }}</option>
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label fw-semibold">{{ __('auth.labelPhone') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input" id="phone" name="phone" value="{{ old('phone', $viewData['user']->getPhone()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="address" class="form-label fw-semibold">{{ __('auth.labelAddress') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input" id="address" name="address" value="{{ old('address', $viewData['user']->getAddress()) }}" required>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">{{ __('admin.cancel') }}</a>
                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">{{ __('admin.updateUser') }}</button>
            </div>
        </form>
    </div>

</div>
@endsection