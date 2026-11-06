<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Utils;

use App\Interfaces\OrderReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class PdfOrderReport implements OrderReport
{
    public function generate(Collection $orders): Response
    {
        $viewData = [];
        $viewData['orders'] = $orders;

        $pdf = Pdf::loadView('admin.order.report', ['viewData' => $viewData]);

        return $pdf->download('orders-report.pdf');
    }
}
