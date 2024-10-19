@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Place Order</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="customer_email" class="form-label">Customer Email</label>
                <input type="email" name="customer_email" id="customer_email" class="form-control" required>
            </div>

            <div id="product-fields">
                <div class="product-item mb-3">
                    <label for="product_id" class="form-label">Select Product</label>
                    <select name="products[0][id]" class="form-select" required>
                        <option value="">Choose a product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                        @endforeach
                    </select>

                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="products[0][quantity]" class="form-control" min="1" value="1" required>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" id="add-product">Add Another Product</button>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>

    <script>
        let productCount = 1;
        document.getElementById('add-product').addEventListener('click', function() {
            const productFields = document.getElementById('product-fields');
            const newProduct = document.createElement('div');
            newProduct.classList.add('product-item', 'mb-3');

            newProduct.innerHTML = `
                <label for="product_id" class="form-label">Select Product</label>
                <select name="products[${productCount}][id]" class="form-select" required>
                    <option value="">Choose a product</option>
                    @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                    @endforeach
            </select>

            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="products[${productCount}][quantity]" class="form-control" min="1" value="1" required>
            `;
            productFields.appendChild(newProduct);
            productCount++;
        });
    </script>
@endsection


