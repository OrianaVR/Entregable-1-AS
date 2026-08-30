@extends('layouts.app') 

@section('content') 

<header class="lume-hero">
    <div class="hero-content">
        <h1>
            {{ $viewData['title'] }}
            <br>
            <em>{{ $viewData['subtitle'] }}</em>
        </h1>
    </div>
</header>

@endsection 