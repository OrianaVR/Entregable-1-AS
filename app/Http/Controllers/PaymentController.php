<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function receipt(string $id): Response
    {
        $query = Order::with(['payment', 'items.product', 'user']);

        $query = $this->restrictToAuthenticatedUser($query);

        $order = $query->where('id', $id)->firstOrFail();

        $total = 0;
        foreach ($order->getItems() as $item) {
            $total += $item->getPrice() * $item->getQuantity();
        }

        $viewData = [];
        $viewData['order'] = $order;
        $viewData['payment'] = $order->getPayment();
        $viewData['total'] = $total;

        $pdf = Pdf::loadView('payment.receipt', ['viewData' => $viewData]);

        return $pdf->download('receipt-order-'.$order->getId().'.pdf');
    }

    public function confirm(string $id): RedirectResponse
    {
        $order = Order::with('payment')->findOrFail($id);
        $payment = $order->getPayment();

        if ($payment !== null) {
            $payment->setStatus('confirmed');
            $payment->save();
        }

        return redirect()->route('order.show', ['id' => $order->getId()])->with('success', __('payment.confirmedSuccess'));
    }

    public function reject(string $id): RedirectResponse
    {
        $order = Order::with('payment')->findOrFail($id);
        $payment = $order->getPayment();

        if ($payment !== null) {
            $payment->setStatus('rejected');
            $payment->save();
        }

        return redirect()->route('order.show', ['id' => $order->getId()])->with('success', __('payment.rejectedSuccess'));
    }
}
