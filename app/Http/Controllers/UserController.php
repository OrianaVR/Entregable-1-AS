<?php

/**
 * @author Maria Laura Tafur Gomez
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function profile(string $id): View
    {
        $viewData = [];
        $viewData['title'] = __('user.myProfileTitle');
        $viewData['subtitle'] = __('user.myProfileSubtitle');
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

        return redirect()->route('user.profile', ['id' => $id])->with('success', __('user.profileUpdated'));
    }
}
