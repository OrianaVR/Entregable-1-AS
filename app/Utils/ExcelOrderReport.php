<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Utils;

use App\Interfaces\OrderReport;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class ExcelOrderReport implements OrderReport
{
    public function generate(Collection $orders): Response
    {
        return response()->streamDownload(function () use ($orders): void {
            $file = fopen('php://output', 'w');
            fwrite($file, "\xEF\xBB\xBF");

            fputcsv($file, [
                __('order.reportColOrder'),
                __('order.reportColCustomer'),
                __('order.reportColDate'),
                __('order.reportColState'),
                __('order.reportColPayment'),
                __('order.total'),
            ], ';');

            foreach ($orders as $order) {
                $payment = $order->getPayment();

                fputcsv($file, [
                    $order->getId(),
                    $order->getUser()->getName(),
                    $order->getCreatedAt()->format('Y-m-d'),
                    __('order.status'.ucfirst($order->getState())),
                    $payment !== null ? __('payment.status'.ucfirst($payment->getStatus())) : '',
                    number_format($order->getTotal(), 2, ',', ''),
                ], ';');
            }

            fclose($file);
        }, 'orders-report.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}
