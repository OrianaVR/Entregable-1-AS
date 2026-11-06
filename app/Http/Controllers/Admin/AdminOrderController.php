<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderReport;
use App\Models\Order;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('order.pageTitle');
        $viewData['orders'] = Order::with(['user', 'payment'])->latest()->get();

        return view('admin.order.index')->with('viewData', $viewData);
    }

    public function report(OrderReport $orderReport): Response
    {
        $orders = Order::with(['user', 'payment', 'items'])->latest()->get();

        return $orderReport->generate($orders);
    }
}
