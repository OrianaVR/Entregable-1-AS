<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function receipt(string $id): Response
    {
        $query = Order::with(['payment', 'items.product', 'user']);

        $user = User::findOrFail(Auth::id());
        if ($user->getRole() !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $order = $query->where('id', $id)->firstOrFail();

        $viewData = [];
        $viewData['order'] = $order;
        $viewData['payment'] = $order->getPayment();
        $viewData['total'] = $order->getTotal();

        $pdf = Pdf::loadView('payment.receipt', ['viewData' => $viewData]);

        return $pdf->download('receipt-order-'.$order->getId().'.pdf');
    }
}
