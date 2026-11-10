<?php

/**
 * @author Maria Laura Tafur Gomez
 */

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use Illuminate\Http\RedirectResponse;

class CurrencyController extends Controller
{
    public function update(CurrencyRequest $request): RedirectResponse
    {
        $request->session()->put('currency', $request->validated('currency'));

        return redirect()->back();
    }
}
