<!DOCTYPE html>
<html>
<head>
    <title>New Order Notification</title>
</head>
<body>
<h1>New Order Placed</h1>

<p>An order has been placed by {{ $order->customer_name }}.</p>
<p>Order Details:</p>
<ul>
    @foreach ($order->products as $product)
        <li>{{ $product->name }} - Quantity: {{ $product->pivot->quantity }}</li>
    @endforeach
</ul>
<p>Total Amount: ${{ number_format($order->total, 2) }}</p>
<p>Customer Email: {{ $order->customer_email }}</p>
</body>
</html>





