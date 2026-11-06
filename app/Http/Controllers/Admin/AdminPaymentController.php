<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class AdminPaymentController extends Controller
{
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
