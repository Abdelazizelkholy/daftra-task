@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Listings</h1>

        <form method="GET" action="{{ route('products.index') }}">
            <input type="text" name="search" placeholder="Search by name" value="{{ request('search') }}">
            <input type="number" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}">
            <input type="number" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}">
            <button type="submit">Search</button>
        </form>

        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- Pagination Links --}}
        {{ $products->links() }}
    </div>
@endsection

