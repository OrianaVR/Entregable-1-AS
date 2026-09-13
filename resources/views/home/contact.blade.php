@extends('layouts.app') 
@section('content') 

<div class="text-center"> 
  <div class="container"> 
    <div class="row"> 
        
        <h1 class="mt-4 mb-3">{{ $viewData['title'] }}</h1>
      
      <div class="col-lg-4 ms-auto">
        <p class="lead">{{ __('contact.labelName') }}: {{ $viewData['name'] }}</p>
      </div>

      <div class="col-lg-4 me-auto">
        <p class="lead">{{ __('contact.labelEmail') }}: {{ $viewData['email'] }}</p>
      </div>

      <div class="col-lg-4 me-auto">
        <p class="lead">{{ __('contact.labelAddress') }}: {{ $viewData['address'] }}</p>
      </div>

      <div class="col-lg-4 me-auto">
        <p class="lead">{{ __('contact.labelPhone') }}: {{ $viewData['phone'] }}</p>
      </div>

    </div> 
  </div> 
</div>

@endsection 