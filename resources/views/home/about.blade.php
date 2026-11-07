{{-- Author: Ana Sofía Angarita Barrios --}}
@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')

<header class="lume-page-hero">
    <p class="lume-eyebrow">{{ __('about.eyebrow') }}</p>
    <h1>
        {{ $viewData['title'] }}
        <br>
        <em>{{ $viewData['subtitle'] }}</em>
    </h1>
</header>

<div class="container pb-5">

    <section class="row g-5 align-items-center lume-about-story">
        <div class="col-lg-6">
            <span class="lume-label">{{ __('about.storyLabel') }}</span>
            <h2 class="lume-section-title mt-2">{{ __('about.storyTitle') }}</h2>
            <p class="lume-product-text">{{ __('about.storyParagraph1') }}</p>
            <p class="lume-product-text">{{ __('about.storyParagraph2') }}</p>
            <a href="{{ route('product.index') }}" class="btn lume-btn-dark mt-2">{{ __('about.shopAction') }}</a>
        </div>
        <div class="col-lg-6">
            <div class="lume-about-visual">
                <span class="lume-about-logo">lumé</span>
                <span class="lume-about-tagline">{{ __('about.tagline') }}</span>
            </div>
        </div>
    </section>

    <section class="lume-about-values">
        <div class="text-center mb-4">
            <span class="lume-label">{{ __('about.valuesLabel') }}</span>
            <h2 class="lume-section-title mt-2">{{ __('about.valuesTitle') }}</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="lume-info-card">
                    <div class="lume-info-icon"><i class="bi bi-droplet"></i></div>
                    <h3 class="lume-info-title">{{ __('about.valueMissionTitle') }}</h3>
                    <p class="lume-info-text">{{ __('about.valueMissionText') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="lume-info-card">
                    <div class="lume-info-icon"><i class="bi bi-patch-check"></i></div>
                    <h3 class="lume-info-title">{{ __('about.valueQualityTitle') }}</h3>
                    <p class="lume-info-text">{{ __('about.valueQualityText') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="lume-info-card">
                    <div class="lume-info-icon"><i class="bi bi-bag-heart"></i></div>
                    <h3 class="lume-info-title">{{ __('about.valueShoppingTitle') }}</h3>
                    <p class="lume-info-text">{{ __('about.valueShoppingText') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="lume-about-team">
        <div class="text-center mb-4">
            <span class="lume-label">{{ __('about.teamLabel') }}</span>
            <h2 class="lume-section-title mt-2">{{ __('about.teamTitle') }}</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-sm-6 col-lg-4">
                <div class="lume-team-card">
                    <div class="lume-team-avatar">A</div>
                    <p class="lume-team-name">{{ __('about.memberAnaName') }}</p>
                    <p class="lume-team-role">{{ __('about.memberAnaRole') }}</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="lume-team-card">
                    <div class="lume-team-avatar">L</div>
                    <p class="lume-team-name">{{ __('about.memberLauraName') }}</p>
                    <p class="lume-team-role">{{ __('about.memberLauraRole') }}</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="lume-team-card">
                    <div class="lume-team-avatar">O</div>
                    <p class="lume-team-name">{{ __('about.memberOrianaName') }}</p>
                    <p class="lume-team-role">{{ __('about.memberOrianaRole') }}</p>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection
