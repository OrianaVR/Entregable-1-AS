<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        $viewData = [];
        $viewData['title'] = 'Login';

        return view('auth.login')->with('viewData', $viewData);
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (! Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return redirect()->route('user.profile', ['id' => $user->getId()]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index');
    }

    public function showRegister(): View
    {
        $viewData = [];
        $viewData['title'] = 'Register';

        return view('auth.register')->with('viewData', $viewData);
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->only(['name', 'email', 'password', 'address', 'phone']);
        $data['role'] = 'user';

        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('user.profile', ['id' => $user->getId()]);
    }
}
