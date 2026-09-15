<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $viewData['order']->getId() }}</title>
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

    <h1>LUMÉ STORE</h1>
    <p class="muted">Receipt / Invoice</p>

    <div class="section">
        <strong>Order #{{ $viewData['order']->getId() }}</strong><br>
        Date: {{ $viewData['order']->getCreatedAt()->format('Y-m-d') }}<br>
        Delivery date: {{ $viewData['order']->getDeliveryDate() }}<br>
        Status: {{ $viewData['order']->getState() }}
    </div>

    <div class="section">
        <strong>Customer</strong><br>
        {{ $viewData['order']->getUser()->getName() }}<br>
        {{ $viewData['order']->getUser()->getEmail() }}<br>
        {{ $viewData['order']->getAddress() }}
    </div>

    <div class="section">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData['order']->getItems() as $item)
                    <tr>
                        <td>{{ $item->getProduct()->getName() }}</td>
                        <td class="text-right">{{ $item->getQuantity() }}</td>
                        <td class="text-right">{{ number_format($item->getPrice(), 2) }}</td>
                        <td class="text-right">{{ number_format($item->getPrice() * $item->getQuantity(), 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3" class="text-right">Total</td>
                    <td class="text-right">{{ number_format($viewData['total'], 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($viewData['payment'] !== null)
        <div class="section">
            <strong>Payment</strong><br>
            Method: {{ $viewData['payment']->getMethod() }}<br>
            Status: {{ $viewData['payment']->getStatus() }}<br>
            Transaction code: {{ $viewData['payment']->getTransactionCode() }}<br>
            Date: {{ $viewData['payment']->getDate() }}
        </div>
    @endif

</body>
</html>
