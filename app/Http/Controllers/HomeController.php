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
        $viewData['routineCategories'] = Category::with('products')->get();

        return view('home.index')->with('viewData', $viewData);
    }

    public function about(): View
    {
        $viewData = [];
        $viewData['title'] = __('about.title');
        $viewData['description'] = __('about.description');
        $viewData['author'] = __('about.author');

        return view('home.about')->with('viewData', $viewData);
    }

    public function contact(): View
    {
        $viewData = [];
        $viewData['title'] = __('contact.title');
        $viewData['name'] = 'Oriana, Laura, Ana';
        $viewData['email'] = 'lumestore@example.com';
        $viewData['phone'] = '+1 (123) 456-7890';
        $viewData['address'] = '123 Main Street, City, Country';

        return view('home.contact')->with('viewData', $viewData);
    }
}