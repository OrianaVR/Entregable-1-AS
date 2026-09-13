<?php

namespace App\Http\Controllers;



use Illuminate\View\View; 
use App\Models\Order;
use App\Models\Client;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;





class OrderController extends Controller 
{

    public function show(string $id): View
    {
    $order = Order::where('id', $id)->where('userId', Auth::id())->firstOrFail();

    $viewData = [];
    $viewData['title'] = 'Order #' . $order->getId();
    $viewData['order'] = $order;

    return view('order.show')->with('viewData', $viewData);
    }

   
    public function index(): View
    {    /** @var \App\Models\Client $client */
        $client = Auth::user();
        $orders = $client->getOrders();
 
        $viewData = [];
        $viewData['title'] = 'My Orders';
        $viewData['orders'] = $orders;
        $viewData['inProcessCount'] = $orders->filter(fn (Order $order): bool => $order->getStatus() === 'inProcess')->count();
        $viewData['completedCount'] = $orders->filter(fn (Order $order): bool => $order->getStatus() === 'completed')->count();
        $viewData['canceledCount'] = $orders->filter(fn (Order $order): bool => $order->getStatus() === 'canceled')->count();
 
        return view('order.index')->with('viewData', $viewData);
    }

  

   
    public function store(OrderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['userId'] = Auth::id();
 
        Order::create($data);
 
        return redirect()->route('order.index')->with('success', 'Order placed successfully.');
    }


    





}
