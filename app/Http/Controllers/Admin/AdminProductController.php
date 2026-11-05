<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Interfaces\ImageStorage;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    private ImageStorage $imageStorage;

    public function __construct(ImageStorage $imageStorage)
    {
        $this->imageStorage = $imageStorage;
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('product.pageTitle');
        $viewData['subtitle'] = __('product.pageSubtitle');
        $viewData['products'] = Product::with('category')->get();

        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('product.createProduct');
        $viewData['categories'] = Category::all();

        return view('product.create')->with('viewData', $viewData);
    }

    public function save(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $this->imageStorage->store($request);

        Product::create($data);

        return redirect()->route('admin.product.index')->with('success', __('product.createdSuccess'));
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['title'] = __('product.editProduct');
        $viewData['product'] = Product::findOrFail($id);
        $viewData['categories'] = Category::all();

        return view('product.edit')->with('viewData', $viewData);
    }

    public function update(UpdateProductRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageStorage->store($request);
        } else {
            unset($data['image']);
        }

        $product->update($data);

        return redirect()->route('admin.product.index')->with('success', __('product.updatedSuccess'));
    }

    public function delete(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.product.index');
    }
}
