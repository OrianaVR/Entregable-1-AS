{{-- Author: Ana Sofía Angarita Barrios --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('payment.receiptTitle', ['id' => $viewData['order']->getId()]) }}</title>
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
        .total-row td {
            font-weight: bold;
            border-top: 2px solid #2B211D;
            border-bottom: none;
        }
        .section {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1>{{ __('order.reportStoreName') }}</h1>
    <p class="muted">{{ __('payment.receiptSubtitle') }}</p>

    <div class="section">
        <strong>{{ __('order.orderHeading', ['id' => $viewData['order']->getId()]) }}</strong><br>
        {{ __('payment.labelDate') }}: {{ $viewData['order']->getCreatedAt()->format('Y-m-d') }}<br>
        {{ __('order.colDeliveryDate') }}: {{ $viewData['order']->getDeliveryDate() }}<br>
        {{ __('payment.labelStatus') }}: {{ __('order.status'.ucfirst($viewData['order']->getState())) }}
    </div>

    <div class="section">
        <strong>{{ __('order.reportColCustomer') }}</strong><br>
        {{ $viewData['order']->getUser()->getName() }}<br>
        {{ $viewData['order']->getUser()->getEmail() }}<br>
        {{ $viewData['order']->getAddress() }}
    </div>

    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>{{ __('order.colProduct') }}</th>
                    <th class="text-right">{{ __('order.colQuantity') }}</th>
                    <th class="text-right">{{ __('order.colUnitPrice') }}</th>
                    <th class="text-right">{{ __('order.colSubtotal') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData['order']->getItems() as $item)
                    <tr>
                        <td>{{ $item->getProduct()->getName() }}</td>
                        <td class="text-right">{{ $item->getQuantity() }}</td>
                        <td class="text-right">{{ number_format($item->getPrice(), 2) }}</td>
                        <td class="text-right">{{ number_format($item->getSubtotal(), 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3" class="text-right">{{ __('order.total') }}</td>
                    <td class="text-right">{{ number_format($viewData['total'], 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($viewData['payment'] !== null)
        <div class="section">
            <strong>{{ __('payment.heading') }}</strong><br>
            {{ __('payment.labelMethod') }}: {{ $viewData['payment']->getMethod() }}<br>
            {{ __('payment.labelStatus') }}: {{ __('payment.status'.ucfirst($viewData['payment']->getStatus())) }}<br>
            {{ __('payment.labelTransactionCode') }}: {{ $viewData['payment']->getTransactionCode() }}<br>
            {{ __('payment.labelDate') }}: {{ $viewData['payment']->getDate() }}
        </div>
    @endif

</body>
</html>
