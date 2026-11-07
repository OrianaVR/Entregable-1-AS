@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')

<header class="lume-page-hero">
    <p class="lume-eyebrow">{{ __('contact.eyebrow') }}</p>
    <h1>
        {{ $viewData['title'] }}
        <br>
        <em>{{ $viewData['subtitle'] }}</em>
    </h1>
</header>

<div class="container pb-5">

    <div class="row g-4">
        <div class="col-sm-6 col-lg-3">
            <div class="lume-info-card">
                <div class="lume-info-icon"><i class="bi bi-envelope"></i></div>
                <span class="lume-label">{{ __('contact.labelEmail') }}</span>
                <a href="{{ $viewData['composeUrl'] }}" target="_blank" rel="noopener" class="lume-info-value">{{ __('contact.emailValue') }}</a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="lume-info-card">
                <div class="lume-info-icon"><i class="bi bi-telephone"></i></div>
                <span class="lume-label">{{ __('contact.labelPhone') }}</span>
                <p class="lume-info-value">{{ __('contact.phoneValue') }}</p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="lume-info-card">
                <div class="lume-info-icon"><i class="bi bi-geo-alt"></i></div>
                <span class="lume-label">{{ __('contact.labelAddress') }}</span>
                <p class="lume-info-value">{{ __('contact.addressValue') }}</p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="lume-info-card">
                <div class="lume-info-icon"><i class="bi bi-clock"></i></div>
                <span class="lume-label">{{ __('contact.labelHours') }}</span>
                <p class="lume-info-value">{{ __('contact.hoursValue') }}</p>
            </div>
        </div>
    </div>

    <section class="lume-contact-cta">
        <div>
            <h2 class="lume-section-title mb-2">{{ __('contact.ctaTitle') }}</h2>
            <p class="lume-product-text mb-0">{{ __('contact.ctaText') }}</p>
        </div>
        <a href="{{ $viewData['composeUrl'] }}" target="_blank" rel="noopener" class="btn lume-btn-dark">
            <i class="bi bi-send me-2"></i>{{ __('contact.ctaAction') }}
        </a>
    </section>

</div>

@endsection
