<?php

/**
 * @author Nawal Oriana Valoyes Renteria
 */

namespace App\Http\Controllers;

use App\Exceptions\ExternalApiException;
use App\Interfaces\ExternalProductProvider;
use Illuminate\View\View;

class Team7ProductController extends Controller
{
    private ExternalProductProvider $productProvider;

    public function __construct(ExternalProductProvider $productProvider)
    {
        $this->productProvider = $productProvider;
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('team7.pageTitle');
        $viewData['subtitle'] = __('team7.pageSubtitle');
        $viewData['products'] = [];
        $viewData['error'] = null;

        try {
            $viewData['products'] = $this->productProvider->fetchProducts();
        } catch (ExternalApiException) {
            $viewData['error'] = __('team7.apiError');
        }

        return view('team7.index')->with('viewData', $viewData);
    }
}
