@extends('layouts.app') 
@section('content') 

<div class="container"> 
  <div class="row"> 

    <h1 class="mt-4 mb-3">{{ $viewData['title'] }}</h1>
    
    <div class="col-lg-4 ms-auto"> 
      <p class="lead">{{ $viewData['description'] }}</p> 
    </div> 

    <div class="col-lg-4 me-auto"> 
      <p class="lead">{{ $viewData['author'] }}</p> 
    </div> 

  </div> 
</div> 

@endsection 