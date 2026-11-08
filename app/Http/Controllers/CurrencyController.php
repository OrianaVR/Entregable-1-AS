<?php

/**
 * @author Maria Laura Tafur Gomez
 */

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Utils\CurrencyUtil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{
    public function testApi(): JsonResponse
    {
        return response()->json([
            'rate' => CurrencyUtil::getUsdToCopRate(),
        ]);
    }

    public function update(CurrencyRequest $request): RedirectResponse
    {
        $request->session()->put('currency', $request->validated('currency'));

        return redirect()->back();
    }
}
