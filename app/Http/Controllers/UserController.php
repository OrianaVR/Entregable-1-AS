<?php

// AUTHOR: Maria Laura Tafur Gomez

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function profile(string $id): View
    {
        $viewData = [];
        $viewData['title'] = 'LUME - My profile';
        $viewData['subtitle'] = 'My profile';
        $viewData['user'] = User::findOrFail($id);

        return view('user.profile')->with('viewData', $viewData);
    }

    public function profileUpdate(UserProfileRequest $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $data = $request->validated();

        if (! $request->filled('password')) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.profile', ['id' => $id])->with('success', 'Profile updated successfully.');
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create User';

        return view('admin.user.create')->with('viewData', $viewData);
    }

    public function save(UserRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return redirect()->route('admin.user.index');
    }

    public function delete(string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index');
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'LUME - Users';
        $viewData['subtitle'] = 'List of Users';
        $viewData['users'] = User::all();

        return view('admin.user.index')->with('viewData', $viewData);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['title'] = 'Edit User';
        $viewData['user'] = User::findOrFail($id);

        return view('admin.user.edit')->with('viewData', $viewData);
    }

    public function update(UserRequest $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $data = $request->validated();

        if (! $request->filled('password')) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.user.index');
    }
}
