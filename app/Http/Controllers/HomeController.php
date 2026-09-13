<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Summer skincare';
        $viewData['subtitle'] = 'for glowing skin.';

        return view('home.index')->with('viewData', $viewData);
    }

    public function about(): View
    {
        $viewData = [];
        $viewData['title'] = 'About us - Online Store';
        $viewData['description'] = 'This is an about page ...';
        $viewData['author'] = 'Developed by: lume';

        return view('home.about')->with('viewData', $viewData);
    }

    public function contact(): View
    {
        $viewData = [];
        $viewData['title'] = 'Contact Page';
        $viewData['name'] = 'Oriana, Laura, Sofia';
        $viewData['email'] = 'lumestore@example.com';
        $viewData['phone'] = '+1 (123) 456-7890';
        $viewData['address'] = '123 Main Street, City, Country';

        return view('home.contact')->with('viewData', $viewData);
    }

    public function devLoginAdmin(): RedirectResponse
    {
        $admin = Client::where('role', 'admin')->first() ?? Client::first();
        if ($admin) {
            Auth::login($admin);

            return redirect()->route('admin.client.index');
        }

        return redirect()->route('home.index');
    }

    public function devLoginClient(): RedirectResponse
    {
        $client = Client::where('role', 'client')->first() ?? Client::first();
        if ($client) {
            Auth::login($client);

            return redirect()->route('client.profile', ['id' => $client->getId()]);
        }

        return redirect()->route('home.index');
    }
}
