<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [];
        $viewData['title'] = __('product.pageTitle');
        $viewData['subtitle'] = __('product.pageSubtitle');

        $searchTerm = (string) $request->query('search', '');
        $viewData['searchTerm'] = $searchTerm;

        if ($searchTerm !== '') {
            $viewData['products'] = Product::where('name', 'LIKE', '%'.$searchTerm.'%')
                ->orWhere('brand', 'LIKE', '%'.$searchTerm.'%')
                ->orderByDesc('featured')
                ->orderBy('name')
                ->get();
        } else {
            $viewData['products'] = Product::orderByDesc('featured')
                ->orderBy('name')
                ->get();
        }

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $product = Product::with(['category', 'reviews.user'])->findOrFail($id);

        $viewData = [];
        $viewData['title'] = $product->getName();
        $viewData['subtitle'] = __('product.productInformation');
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }
}
