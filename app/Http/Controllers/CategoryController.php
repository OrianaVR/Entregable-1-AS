<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('category.pageTitle');
        $viewData['subtitle'] = __('category.subtitleList');
        $viewData['categories'] = Category::withCount('products')->get();

        return view('admin.category.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('category.createCategory');

        return view('admin.category.create')->with('viewData', $viewData);
    }

    public function save(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.category.index');
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['title'] = __('category.editCategory');
        $viewData['category'] = Category::findOrFail($id);

        return view('admin.category.edit')->with('viewData', $viewData);
    }

    public function update(StoreCategoryRequest $request, string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());

        return redirect()->route('admin.category.index');
    }

    public function delete(string $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category.index');
    }
}
