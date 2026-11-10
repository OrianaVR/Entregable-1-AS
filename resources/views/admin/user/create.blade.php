{{-- Author: Maria Laura Tafur Gómez --}}
@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
<div class="lume-container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            @include('partials.breadcrumb', [
                'crumbs' => [
                    ['label' => __('admin.pageTitleUsers'), 'url' => route('admin.user.index')],
                    ['label' => __('admin.createUser')],
                ],
            ])
            <h2 class="lume-page-title m-0">{{ __('admin.createUser') }}</h2>
        </div>

        <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
            {{ __('admin.cancel') }}
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ __('form.reviewErrors') }}
        </div>
    @endif

    <div class="lume-card p-4">
        <form action="{{ route('admin.user.store') }}" method="POST" novalidate data-live-validate>
            @csrf

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label fw-semibold">{{ __('auth.labelName') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @include('partials.fieldError', ['field' => 'name'])
                </div>

                <div class="col-12 col-md-6">
                    <label for="email" class="form-label fw-semibold">{{ __('auth.labelEmail') }} <span class="text-danger">*</span></label>
                    <input type="email" class="form-control lume-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @include('partials.fieldError', ['field' => 'email'])
                </div>

                <div class="col-12 col-md-6">
                    <label for="password" class="form-label fw-semibold">{{ __('auth.labelPassword') }} <span class="text-danger">*</span></label>
                    <input type="password" class="form-control lume-input @error('password') is-invalid @enderror" id="password" name="password" minlength="6" maxlength="6" required>
                    @include('partials.fieldError', ['field' => 'password'])
                </div>

                <div class="col-12 col-md-6">
                    <label for="role" class="form-label fw-semibold">{{ __('admin.labelRole') }} <span class="text-danger">*</span></label>
                    <select class="form-select lume-input @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>{{ __('admin.roleUser') }}</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>{{ __('admin.roleAdmin') }}</option>
                    </select>
                    @include('partials.fieldError', ['field' => 'role'])
                </div>

                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label fw-semibold">{{ __('auth.labelPhone') }} <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control lume-input @error('phone') is-invalid @enderror" id="phone" name="phone" inputmode="numeric" pattern="[0-9]{10,}" data-digits-only data-pattern-message="{{ __('form.phoneDigits') }}" value="{{ old('phone') }}" required>
                    @include('partials.fieldError', ['field' => 'phone'])
                </div>

                <div class="col-12 col-md-6">
                    <label for="address" class="form-label fw-semibold">{{ __('auth.labelAddress') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input @error('address') is-invalid @enderror" id="address" name="address" minlength="8" value="{{ old('address') }}" required>
                    @include('partials.fieldError', ['field' => 'address'])
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">{{ __('admin.cancel') }}</a>
                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">{{ __('admin.createUser') }}</button>
            </div>
        </form>
    </div>

</div>
@endsection