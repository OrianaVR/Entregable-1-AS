@extends('layouts.app') 
@section('content') 

<div class="text-center"> 
  <div class="container"> 
    <div class="row"> 
        
        <h1 class="mt-4 mb-3">{{ $viewData['title'] }}</h1>
      
      <div class="col-lg-4 ms-auto"> 
        <p class="lead">Name: {{ $viewData['name'] }}</p> 
      </div> 

      <div class="col-lg-4 me-auto"> 
        <p class="lead">Email: {{ $viewData['email'] }}</p> 
      </div> 

      <div class="col-lg-4 me-auto"> 
        <p class="lead">Address: {{ $viewData['address'] }}</p> 
      </div> 

      <div class="col-lg-4 me-auto"> 
        <p class="lead">Phone: {{ $viewData['phone'] }}</p> 
      </div> 

    </div> 
  </div> 
</div>

@endsection 