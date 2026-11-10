<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function update(LanguageRequest $request): RedirectResponse
    {
        $request->session()->put('locale', $request->validated('locale'));

        return redirect()->back();
    }
}
