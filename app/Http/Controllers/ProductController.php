<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Interfaces\ImageStorage;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    private ImageStorage $imageStorage;

    public function __construct(ImageStorage $imageStorage)
    {
        $this->imageStorage = $imageStorage;
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Products';
        $viewData['subtitle'] = 'List of products';
        $viewData['products'] = Product::all();

        return view('product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $product = Product::with('category')->findOrFail($id);

        $viewData = [];
        $viewData['title'] = $product->getName().' - LUMÉ STORE';
        $viewData['subtitle'] = 'Product information';
        $viewData['product'] = $product;

        return view('product.show')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create product';
        $viewData['categories'] = Category::all();

        return view('product.create')->with('viewData', $viewData);
    }

    public function save(StoreProductRequest $request): View
    {
        $data = $request->validated();
        $data['image'] = $this->imageStorage->store($request);

        Product::create($data);

        return view('product.save')->with('message', 'Product created successfully!');
    }

    public function delete(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index');
    }
}
