<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('order.pageTitle');
        $viewData['orders'] = Order::with(['user', 'payment'])->latest()->get();

        return view('admin.order.index')->with('viewData', $viewData);
    }
}
