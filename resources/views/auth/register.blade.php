{{-- Author: Ana Sofía Angarita Barrios --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container pt-4">
    @include('partials.breadcrumb', [
        'crumbs' => [
            ['label' => __('layout.navHome'), 'url' => route('home.index')],
            ['label' => __('auth.registerTitle')],
        ],
    ])
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 mt-5">
            <h1 class="mb-4">{{ $viewData['title'] }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ __('form.reviewErrors') }}
                </div>
            @endif

            <form action="{{ route('register.attempt') }}" method="POST" novalidate data-live-validate>
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('auth.labelName') }}</label>
                    <input type="text" class="form-control lume-input @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @include('partials.fieldError', ['field' => 'name'])
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('auth.labelEmail') }}</label>
                    <input type="email" class="form-control lume-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @include('partials.fieldError', ['field' => 'email'])
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('auth.labelPhone') }}</label>
                    <input type="tel" class="form-control lume-input @error('phone') is-invalid @enderror" id="phone" name="phone" inputmode="numeric" pattern="[0-9]{10,}" data-digits-only data-pattern-message="{{ __('form.phoneDigits') }}" value="{{ old('phone') }}" required>
                    @include('partials.fieldError', ['field' => 'phone'])
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('auth.labelAddress') }}</label>
                    <input type="text" class="form-control lume-input @error('address') is-invalid @enderror" id="address" name="address" minlength="8" value="{{ old('address') }}" required>
                    @include('partials.fieldError', ['field' => 'address'])
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('auth.labelPassword') }}</label>
                    <input type="password" class="form-control lume-input @error('password') is-invalid @enderror" id="password" name="password" minlength="6" maxlength="6" required>
                    @include('partials.fieldError', ['field' => 'password'])
                </div>

                <button type="submit" class="btn btn-primary w-100">{{ __('auth.buttonRegister') }}</button>
            </form>

            <p class="mt-3 text-center">
                {{ __('auth.hasAccount') }} <a href="{{ route('login') }}">{{ __('auth.loginTitle') }}</a>
            </p>
        </div>
    </div>
</div>
@endsection