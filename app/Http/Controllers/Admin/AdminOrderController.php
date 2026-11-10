<?php

/**
 * @author Ana Sofía Angarita Barrios
 * @author Nawal Oriana Valoyes Renteria
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderReport;
use App\Models\Order;
use App\Utils\OrderUtil;
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

        $viewData['inProcessCount'] = OrderUtil::countByState($orders, 'inProcess');
        $viewData['completedCount'] = OrderUtil::countByState($orders, 'completed');
        $viewData['canceledCount'] = OrderUtil::countByState($orders, 'canceled');

        $currency = session('currency', 'USD');
        $items = OrderUtil::itemsOf($orders);
        $viewData['totals'] = OrderUtil::formatTotals($orders, $currency);
        $viewData['unitPrices'] = OrderUtil::formatUnitPrices($items, $currency);
        $viewData['subtotals'] = OrderUtil::formatSubtotals($items, $currency);

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
