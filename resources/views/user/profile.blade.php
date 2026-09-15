{{-- Author: Maria Laura Tafur Gómez --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="profile-page-wrapper">

    <div class="profile-header text-center" style="padding-top: 60px; padding-bottom: 30px;">
        <h1 class="profile-title text-center mb-2" style="font-size: 42px;">{{ __('auth.navMyAccount') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center profile-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('layout.navHome') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('auth.navMyAccount') }}</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid px-3 py-4" style="max-width: 1380px;">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-5">

            <div class="col-12 col-md-4 col-lg-3">
                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('user.profile', ['id' => $viewData['user']->getId()]) }}" class="btn text-white fw-bold text-start py-3 px-4 rounded-3 shadow-sm d-flex align-items-center justify-content-between" style="background-color: #e5a93c; border-color: #e5a93c;">
                        <span><i class="bi bi-person-fill me-2"></i>{{ __('auth.personalInformation') }}</span>
                        <i class="bi bi-chevron-right small"></i>
                    </a>

                    <a href="{{ route('order.index') }}" class="btn btn-light border text-start py-3 px-4 rounded-3 text-dark fw-medium shadow-sm d-flex align-items-center justify-content-between" style="background-color: #ffffff;">
                        <span><i class="bi bi-bag-fill me-2 text-muted"></i>{{ __('auth.myOrders') }}</span>
                        <i class="bi bi-chevron-right small text-muted"></i>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger text-start py-3 px-4 rounded-3 fw-medium shadow-sm d-flex align-items-center justify-content-between w-100" style="background-color: #ffffff;">
                            <span><i class="bi bi-box-arrow-right me-2"></i>{{ __('auth.navLogout') }}</span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-8 ms-auto">
                <div class="profile-card">
                    <h4 class="fw-semibold mb-4 text-dark border-bottom pb-3">{{ __('auth.personalInformation') }}</h4>

                    <form action="{{ route('user.profile.update', ['id' => $viewData['user']->getId()]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label profile-label">{{ __('auth.labelName') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control profile-input" id="name" name="name" value="{{ old('name', $viewData['user']->getName()) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label profile-label">{{ __('auth.labelEmail') }} <span class="text-danger">*</span></label>
                            <input type="email" class="form-control profile-input" id="email" name="email" value="{{ old('email', $viewData['user']->getEmail()) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label profile-label">{{ __('auth.labelPhone') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control profile-input" id="phone" name="phone" value="{{ old('phone', $viewData['user']->getPhone()) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label profile-label">{{ __('auth.labelAddress') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control profile-input" id="address" name="address" value="{{ old('address', $viewData['user']->getAddress()) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label profile-label">{{ __('auth.labelPassword') }} <small class="text-muted">{{ __('auth.passwordHint') }}</small></label>
                            <input type="password" class="form-control profile-input" id="password" name="password" placeholder="{{ __('auth.passwordPlaceholder') }}">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">
                                {{ __('auth.updateChanges') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection