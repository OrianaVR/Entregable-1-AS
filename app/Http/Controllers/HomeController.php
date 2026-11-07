<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('home.title');
        $viewData['subtitle'] = __('home.subtitle');
        $viewData['categories'] = Category::with('products')->get();

        return view('home.index')->with('viewData', $viewData);
    }

    public function about(): View
    {
        $viewData = [];
        $viewData['title'] = __('about.title');
        $viewData['subtitle'] = __('about.subtitle');

        return view('home.about')->with('viewData', $viewData);
    }

    public function contact(): View
    {
        $viewData = [];
        $viewData['title'] = __('contact.title');
        $viewData['subtitle'] = __('contact.subtitle');
        $viewData['composeUrl'] = 'https://mail.google.com/mail/?'.http_build_query([
            'view' => 'cm',
            'fs' => 1,
            'to' => __('contact.emailValue'),
            'su' => __('contact.emailSubject'),
        ]);

        return view('home.contact')->with('viewData', $viewData);
    }
}
