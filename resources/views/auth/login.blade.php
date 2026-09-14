@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 mt-5">
            <h1 class="mb-4">{{ $viewData['title'] }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.attempt') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('auth.labelEmail') }}</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('auth.labelPassword') }}</label>
                    <input type="password" class="form-control" id="password" name="password" required>
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
