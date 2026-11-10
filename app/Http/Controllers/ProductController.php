<?php

/**
 * @author Ana Sofía Angarita Barrios
 * @author Maria Laura Tafur Gomez
 * @author Maria Laura Tafur Gomez
 */

namespace App\Http\Controllers;

use App\Models\Product;
use App\Utils\CurrencyUtil;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [];
        $viewData['title'] = __('product.pageTitle');
        $viewData['subtitle'] = __('product.pageSubtitle');
        $viewData['currency'] = session('currency', 'USD');

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

        $viewData['currencyPrices'] = [];

        foreach ($viewData['products'] as $product) {
            $viewData['currencyPrices'][$product->getId()] = CurrencyUtil::convertAndFormat(
                $product->getPrice(),
                $viewData['currency']
            );
        }

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $product = Product::with(['category', 'reviews.user'])->findOrFail($id);
        $currency = session('currency', 'USD');

        $currencyPrice = CurrencyUtil::convertAndFormat($product->getPrice(), $currency);

        $viewData = [];
        $viewData['title'] = $product->getName();
        $viewData['subtitle'] = __('product.productInformation');
        $viewData['product'] = $product;
        $viewData['currencyPrice'] = $currencyPrice;

        return view('product.show')->with('viewData', $viewData);
    }
}
