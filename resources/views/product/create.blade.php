@extends('layouts.app')
@section('content')

<div class="container py-5 hero-content">
    <h1>
        {{ $viewData['title'] }}
    </h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="product-form">

                <div class="form-title">
                    {{ $viewData['title'] }}
                </div>

                <div class="form-body">

                    @if ($errors->any())
                        <ul id="errors" class="alert alert-danger list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ route('product.save') }}" enctype="multipart/form-data">

                        @csrf

                        <label for="name">Name:</label>
                        <input
                            type="text"
                            placeholder="Enter product name (Example: Hydrating Serum)"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                        >

                        <label for="brand">Brand:</label>
                        <input
                            type="text"
                            placeholder="Enter brand (Example: Garnier)"
                            id="brand"
                            name="brand"
                            value="{{ old('brand') }}"
                        >

                        <label for="price">Price:</label>
                        <input
                            type="text"
                            placeholder="Enter price (Example: 19.99)"
                            id="price"
                            name="price"
                            value="{{ old('price') }}"
                        >

                        <label for="description">Description:</label>
                        <input
                            type="text"
                            placeholder="Enter description (Example: A hydrating serum that moisturizes your skin)"
                            id="description"
                            name="description"
                            value="{{ old('description') }}"
                        >

                        <label for="stock">Stock:</label>
                        <input
                            type="text"
                            placeholder="Enter stock (Example: 100)"
                            id="stock"
                            name="stock"
                            value="{{ old('stock') }}"
                        >

                        <label for="category_id">Category:</label>
                        <select id="category_id" name="category_id">
                            @foreach ($viewData['categories'] as $category)
                                <option value="{{ $category->getId() }}" {{ old('category_id') == $category->getId() ? 'selected' : '' }}>
                                    {{ $category->getName() }}
                                </option>
                            @endforeach
                        </select>

                        <label for="image">Image:</label>
                        <input
                            type="file"
                            name="image"
                            id="image"
                            accept="image/*"
                        >
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
