@extends('layouts.app')
@section('content')

    @isset($message)
        <p class="text-center" style="color:darkgreen">{{ $message }}</p>
    @endisset

    <p class="text-center">
        <a href="{{ route('product.index') }}" class="btn btn-primary">Go to Products</a>
    </p>

@endsection
