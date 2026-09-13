@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
<div class="lume-container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('admin.client.index') }}" class="text-decoration-none">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User #{{ $viewData['client']->getId() }}</li>
                </ol>
            </nav>
            <h2 class="lume-page-title m-0">Edit User: {{ $viewData['client']->getName() }}</h2>
        </div>

        <a href="{{ route('admin.client.index') }}" class="btn btn-outline-secondary">
            Cancel
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="lume-card p-4">
        <form action="{{ route('admin.client.update', ['id' => $viewData['client']->getId()]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input" id="name" name="name" value="{{ old('name', $viewData['client']->getName()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control lume-input" id="email" name="email" value="{{ old('email', $viewData['client']->getEmail()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control lume-input" id="password" name="password" value="{{ old('password', $viewData['client']->getPassword()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="role" class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                    <select class="form-select lume-input" id="role" name="role" required>
                        <option value="client" {{ old('role', $viewData['client']->getRole()) === 'client' ? 'selected' : '' }}>Client</option>
                        <option value="admin" {{ old('role', $viewData['client']->getRole()) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input" id="phone" name="phone" value="{{ old('phone', $viewData['client']->getPhone()) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="address" class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control lume-input" id="address" name="address" value="{{ old('address', $viewData['client']->getAddress()) }}" required>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                <a href="{{ route('admin.client.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Update User</button>
            </div>
        </form>
    </div>

</div>
@endsection

