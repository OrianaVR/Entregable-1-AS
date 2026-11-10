{{-- Author: Ana Sofía Angarita Barrios --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container pt-4">
    @include('partials.breadcrumb', [
        'crumbs' => [
            ['label' => __('layout.navHome'), 'url' => route('home.index')],
            ['label' => __('auth.loginTitle')],
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

            <form action="{{ route('login.attempt') }}" method="POST" novalidate data-live-validate>
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('auth.labelEmail') }}</label>
                    <input type="email" class="form-control lume-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @include('partials.fieldError', ['field' => 'email'])
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('auth.labelPassword') }}</label>
                    <input type="password" class="form-control lume-input @error('password') is-invalid @enderror" id="password" name="password" required>
                    @include('partials.fieldError', ['field' => 'password'])
                </div>

                <button type="submit" class="btn btn-primary w-100">{{ __('auth.buttonLogin') }}</button>
            </form>

            <p class="mt-3 text-center">
                {{ __('auth.noAccount') }} <a href="{{ route('register') }}">{{ __('auth.registerTitle') }}</a>
            </p>
        </div>
    </div>
</div>
@endsection