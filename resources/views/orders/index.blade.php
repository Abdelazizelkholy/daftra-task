@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders</h1>

        @if ($orders->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Total Amount</th>
                    <th>Products</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>
                            <ul>
                                @foreach ($order->products as $product)
                                    <li>{{ $product->name }} ({{ $product->pivot->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $orders->links() }} <!-- Pagination links -->
        @else
            <div class="alert alert-info">No orders found.</div>
        @endif
    </div>
@endsection




