<?php

/**
 * @author Ana Sofía Angarita Barrios
 * @author Nawal Oriana Valoyes Renteria
 */

namespace App\Http\Controllers;

use App\Exceptions\InsufficientStockException;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Utils\CartUtil;
use App\Utils\CurrencyUtil;
use App\Utils\DeliveryDateUtil;
use Illuminate\Database\Eloquent\Collection;
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

        /** @var User $user */
        $user = Auth::user();
        if ($user->getRole() !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $order = $query->where('id', $id)->firstOrFail();
        $currency = session('currency', 'USD');

        $viewData = [];
        $viewData['title'] = __('order.orderHeading', ['id' => $order->getId()]);
        $viewData['order'] = $order;
        $viewData['total'] = CurrencyUtil::convertAndFormat($order->getTotal(), $currency);
        $viewData['unitPrices'] = $this->formatItemPrices(new Collection([$order]), $currency, false);
        $viewData['subtotals'] = $this->formatItemPrices(new Collection([$order]), $currency, true);

        return view('order.show')->with('viewData', $viewData);
    }

    public function index(): View
    {
        $orders = Order::with(['items.product', 'payment'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
        $currency = session('currency', 'USD');

        $viewData = [];
        $viewData['title'] = __('order.pageTitle');
        $viewData['orders'] = $orders;
        $viewData['totals'] = [];

        foreach ($orders as $order) {
            $viewData['totals'][$order->getId()] = CurrencyUtil::convertAndFormat($order->getTotal(), $currency);
        }

        $viewData['unitPrices'] = $this->formatItemPrices($orders, $currency, false);
        $viewData['subtotals'] = $this->formatItemPrices($orders, $currency, true);
        $viewData['inProcessCount'] = $orders->filter(fn (Order $order): bool => $order->getState() === 'inProcess')->count();
        $viewData['completedCount'] = $orders->filter(fn (Order $order): bool => $order->getState() === 'completed')->count();
        $viewData['canceledCount'] = $orders->filter(fn (Order $order): bool => $order->getState() === 'canceled')->count();

        return view('order.index')->with('viewData', $viewData);
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
        $viewData['address'] = User::findOrFail(Auth::id())->getAddress();
        $viewData['deliveryDate'] = DeliveryDateUtil::estimatedDate();
        $viewData['deliveryDays'] = DeliveryDateUtil::BUSINESS_DAYS;

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

    private function formatItemPrices(Collection $orders, string $currency, bool $asSubtotal): array
    {
        $formatted = [];

        foreach ($orders as $order) {
            foreach ($order->getItems() as $item) {
                $amount = $asSubtotal ? $item->getPrice() * $item->getQuantity() : $item->getPrice();
                $formatted[$item->getId()] = CurrencyUtil::convertAndFormat($amount, $currency);
            }
        }

        return $formatted;
    }
}
