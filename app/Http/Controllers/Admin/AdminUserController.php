<?php

/**
 * @author Maria Laura Tafur Gomez
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.pageTitleUsers');
        $viewData['subtitle'] = __('admin.subtitleUsersList');
        $viewData['users'] = User::all();

        return view('admin.user.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.createUser');

        return view('admin.user.create')->with('viewData', $viewData);
    }

    public function save(UserRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return redirect()->route('admin.user.index');
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['title'] = __('admin.editUser');
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

    public function delete(string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index');
    }
}
