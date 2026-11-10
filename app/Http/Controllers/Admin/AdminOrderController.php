<?php

/**
 * @author Ana Sofía Angarita Barrios
 * @author Nawal Oriana Valoyes Renteria
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

        $orders = Order::with(['user', 'payment', 'items.product'])
            ->latest()
            ->get();

        $viewData['title'] = __('order.pageTitle');
        $viewData['orders'] = $orders;

        $viewData['inProcessCount'] = $orders
            ->where('state', 'inProcess')
            ->count();

        $viewData['completedCount'] = $orders
            ->where('state', 'completed')
            ->count();

        $viewData['canceledCount'] = $orders
            ->where('state', 'canceled')
            ->count();

        $viewData['totals'] = [];

        foreach ($orders as $order) {
            $viewData['totals'][$order->getId()] = $order->getTotal();
        }

        return view('admin.order.index')->with('viewData', $viewData);
    }

    public function report(OrderReport $orderReport): Response
    {
        $orders = Order::with(['user', 'payment', 'items.product'])
            ->latest()
            ->get();

        return $orderReport->generate($orders);
    }
}
