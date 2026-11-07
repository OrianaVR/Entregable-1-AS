{{-- Author: Ana Sofía Angarita Barrios --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('order.reportTitle') }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #2B211D;
        }
        h1 {
            font-size: 20px;
            margin-bottom: 0;
        }
        .muted {
            color: #6B6560;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        th, td {
            border-bottom: 1px solid #E9D6C9;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #FCECE1;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

    <h1>{{ __('order.reportStoreName') }}</h1>
    <p class="muted">{{ __('order.reportTitle') }}</p>
    <p class="muted">{{ __('order.reportGeneratedAt', ['date' => now()->format('Y-m-d H:i')]) }}</p>

    <table>
        <thead>
            <tr>
                <th>{{ __('order.reportColOrder') }}</th>
                <th>{{ __('order.reportColCustomer') }}</th>
                <th>{{ __('order.reportColDate') }}</th>
                <th>{{ __('order.reportColState') }}</th>
                <th>{{ __('order.reportColPayment') }}</th>
                <th class="text-right">{{ __('order.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($viewData['orders'] as $order)
                <tr>
                    <td>#{{ $order->getId() }}</td>
                    <td>{{ $order->getUser()->getName() }}</td>
                    <td>{{ $order->getCreatedAt()->format('Y-m-d') }}</td>
                    <td>{{ __('order.status'.ucfirst($order->getState())) }}</td>
                    <td>
                        @if ($order->getPayment() !== null)
                            {{ __('payment.status'.ucfirst($order->getPayment()->getStatus())) }}
                        @endif
                    </td>
                    <td class="text-right">${{ number_format($order->getTotal(), 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">{{ __('order.reportEmpty') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
