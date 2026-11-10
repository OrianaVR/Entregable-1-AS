<?php

/**
 * @author Ana Sofía Angarita Barrios
 * @author Nawal Oriana Valoyes Renteria
 */

namespace App\Http\Controllers;

use App\Exceptions\InsufficientStockException;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Utils\CartUtil;
use App\Utils\CurrencyUtil;
use App\Utils\DeliveryDateUtil;
use App\Utils\OrderUtil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    private CartUtil $cartUtil;

    public function __construct(CartUtil $cartUtil)
    {
        $this->cartUtil = $cartUtil;
    }

    public function show(string $id): View
    {
        $query = Order::with(['items.product', 'payment', 'user']);

        $user = User::findOrFail(Auth::id());
        if ($user->getRole() !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $order = $query->where('id', $id)->firstOrFail();
        $currency = session('currency', 'USD');

        $viewData = [];
        $viewData['title'] = __('order.orderHeading', ['id' => $order->getId()]);
        $viewData['order'] = $order;
        $viewData['total'] = CurrencyUtil::convertAndFormat($order->getTotal(), $currency);
        $viewData['unitPrices'] = OrderUtil::formatUnitPrices($order->getItems(), $currency);
        $viewData['subtotals'] = OrderUtil::formatSubtotals($order->getItems(), $currency);

        return view('order.show')->with('viewData', $viewData);
    }

    public function index(): View
    {
        $orders = Order::with(['items.product', 'payment'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
        $currency = session('currency', 'USD');
        $items = OrderUtil::itemsOf($orders);

        $viewData = [];
        $viewData['title'] = __('order.pageTitle');
        $viewData['orders'] = $orders;
        $viewData['totals'] = OrderUtil::formatTotals($orders, $currency);
        $viewData['unitPrices'] = OrderUtil::formatUnitPrices($items, $currency);
        $viewData['subtotals'] = OrderUtil::formatSubtotals($items, $currency);
        $viewData['inProcessCount'] = OrderUtil::countByState($orders, 'inProcess');
        $viewData['completedCount'] = OrderUtil::countByState($orders, 'completed');
        $viewData['canceledCount'] = OrderUtil::countByState($orders, 'canceled');

        return view('order.index')->with('viewData', $viewData);
    }

    public function checkout(): View
    {
        $cartItems = $this->cartUtil->buildCartItems(session('cart', []));
        $currency = session('currency', 'USD');
        $total = array_sum(array_column($cartItems, 'subtotal'));

        $viewData = [];
        $viewData['title'] = __('order.checkoutTitle');
        $viewData['cartItems'] = $cartItems;
        $viewData['subtotals'] = [];
        $viewData['total'] = CurrencyUtil::convertAndFormat($total, $currency);
        $viewData['address'] = User::findOrFail(Auth::id())->getAddress();
        $viewData['deliveryDate'] = DeliveryDateUtil::estimatedDate();
        $viewData['deliveryDays'] = DeliveryDateUtil::BUSINESS_DAYS;

        foreach ($cartItems as $cartItem) {
            $viewData['subtotals'][$cartItem['product']->getId()] = CurrencyUtil::convertAndFormat($cartItem['subtotal'], $currency);
        }

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
            $order = $this->cartUtil->createOrderFromCart($cart, $data, $paymentMethod, Auth::id());
        } catch (InsufficientStockException) {
            return redirect()->route('order.checkout')->with('error', __('order.insufficientStock'));
        }

        session()->forget('cart');

        return redirect()->route('order.show', ['id' => $order->getId()])->with('success', __('order.orderPlaced'));
    }
}
