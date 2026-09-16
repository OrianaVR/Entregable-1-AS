{{-- Author: Maria Laura Tafur Gómez --}}
@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
<div class="lume-container pt-3">

    <div class="row mb-4">
        <div class="col-auto">
            <div class="card border-0 shadow-sm rounded-3 px-4 py-3 bg-white" style="min-width: 220px;">
                <div class="text-muted fw-semibold small mb-1 text-uppercase" style="letter-spacing: 0.5px; font-size: 11px;">Current Users</div>
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-2 text-white d-flex align-items-center justify-content-center" style="background-color: var(--coral); width: 38px; height: 38px; font-size: 18px;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <span class="fs-3 fw-bold text-dark">{{ count($viewData['users']) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="lume-page-title m-0">Users</h2>

        <a href="{{ route('admin.user.create') }}" class="btn btn-primary px-3 py-2 fw-semibold">
            <i class="bi bi-plus-lg me-1"></i> Create User
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-3 bg-white overflow-hidden mb-4">

        <div class="p-3 border-bottom bg-white d-flex align-items-center">
            <input class="form-check-input" type="checkbox">
        </div>

        <div class="table-responsive">
            <table class="table lume-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th class="text-center">ADMIN</th>
                        <th class="text-center">USER</th>
                        <th class="text-end pe-4">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($viewData['users'] as $user)
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox" value="{{ $user->getId() }}">
                            </td>
                            <td>
                                <a href="{{ route('admin.user.edit', ['id' => $user->getId()]) }}" class="lume-id-link">
                                    {{ $user->getId() }}
                                </a>
                            </td>
                            <td class="fw-medium text-dark">
                                {{ $user->getName() }}
                            </td>
                            <td class="text-muted">
                                {{ $user->getEmail() }}
                            </td>
                            <td class="text-center">
                                @if ($user->getRole() === 'admin')
                                    <i class="bi bi-check-circle text-success fs-5"></i>
                                @else
                                    <i class="bi bi-x-circle text-danger fs-5"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($user->getRole() === 'user')
                                    <i class="bi bi-check-circle text-success fs-5"></i>
                                @else
                                    <i class="bi bi-x-circle text-danger fs-5"></i>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="lume-actions-group">
                                    <a href="{{ route('user.profile', ['id' => $user->getId()]) }}" class="lume-action-icon" title="View Profile">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.user.edit', ['id' => $user->getId()]) }}" class="lume-action-icon" title="Edit User">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.user.delete', ['id' => $user->getId()]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="lume-action-icon text-danger border-0 bg-transparent p-0" title="Delete User">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                No users found. Click "Create User" to add one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3 border-top bg-white d-flex align-items-center justify-content-between">
        </div>
    </div>

</div>
@endsection