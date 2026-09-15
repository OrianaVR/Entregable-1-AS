<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Exceptions\InsufficientStockException;
use App\Http\Requests\OrderRequest;
use App\Interfaces\OrderCreation;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    private OrderCreation $orderCreation;

    public function __construct(OrderCreation $orderCreation)
    {
        $this->orderCreation = $orderCreation;
    }

    public function show(string $id): View
    {
        $query = Order::with(['items.product', 'payment', 'user']);
        
        /** @var User $user */
        $user = Auth::user();
        if ($user->getRole() !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $order = $query->where('id', $id)->firstOrFail();

        $total = 0;
        foreach ($order->getItems() as $item) {
            $total += $item->getPrice() * $item->getQuantity();
        }

        $viewData = [];
        $viewData['title'] = __('order.orderHeading', ['id' => $order->getId()]);
        $viewData['order'] = $order;
        $viewData['total'] = $total;

        return view('order.show')->with('viewData', $viewData);
    }

    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $orders = $user->getOrders();

        $viewData = [];
        $viewData['title'] = __('order.pageTitle');
        $viewData['orders'] = $orders;
        $viewData['inProcessCount'] = $orders->filter(fn (Order $order): bool => $order->getState() === 'inProcess')->count();
        $viewData['completedCount'] = $orders->filter(fn (Order $order): bool => $order->getState() === 'completed')->count();
        $viewData['canceledCount'] = $orders->filter(fn (Order $order): bool => $order->getState() === 'canceled')->count();

        return view('order.index')->with('viewData', $viewData);
    }

    public function adminIndex(): View
    {
        $viewData = [];
        $viewData['title'] = __('order.pageTitle');
        $viewData['orders'] = Order::with(['user', 'payment'])->latest()->get();

        return view('admin.order.index')->with('viewData', $viewData);
    }

    public function checkout(): View
    {
        $cart = session('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);

            if ($product === null) {
                continue;
            }

            $subtotal = $product->getPrice() * $quantity;
            $total += $subtotal;

            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        $viewData = [];
        $viewData['title'] = __('order.checkoutTitle');
        $viewData['cartItems'] = $cartItems;
        $viewData['total'] = $total;

        return view('order.checkout')->with('viewData', $viewData);
    }

    public function store(OrderRequest $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('order.checkout')->with('error', __('order.emptyCart'));
        }

        $data = $request->validated();
        $paymentMethod = $data['payment_method'];
        unset($data['payment_method']);

        try {
            $order = $this->orderCreation->createFromCart($cart, $data, $paymentMethod, Auth::id());
        } catch (InsufficientStockException) {
            return redirect()->route('order.checkout')->with('error', __('order.insufficientStock'));
        }

        session()->forget('cart');

        return redirect()->route('order.show', ['id' => $order->getId()])->with('success', __('order.orderPlaced'));
    }
}