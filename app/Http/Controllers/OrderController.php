<?php

// AUTHOR: Maria Laura Tafur Gomez

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function show(string $id): View
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $viewData = [];
        $viewData['title'] = 'Order #'.$order->getId();
        $viewData['order'] = $order;

        return view('order.show')->with('viewData', $viewData);
    }

    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $orders = $user->getOrders();

        $viewData = [];
        $viewData['title'] = 'My Orders';
        $viewData['orders'] = $orders;
        $viewData['inProcessCount'] = $orders->filter(fn (Order $order): bool => $order->getState() === 'inProcess')->count();
        $viewData['completedCount'] = $orders->filter(fn (Order $order): bool => $order->getState() === 'completed')->count();
        $viewData['canceledCount'] = $orders->filter(fn (Order $order): bool => $order->getState() === 'canceled')->count();

        return view('order.index')->with('viewData', $viewData);
    }

    public function store(OrderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        Order::create($data);

        return redirect()->route('order.index')->with('success', 'Order placed successfully.');
    }
}
