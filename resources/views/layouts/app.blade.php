
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Link to your CSS -->
</head>
<body>
<header>
    <nav>
        <!-- Navigation links -->
        <a href="{{ route('products.index') }}">Products</a>
        <a href="{{ route('orders.index') }}">Orders</a>
        <!-- Add more links as needed -->
    </nav>
</header>

<main>
    @yield('content') <!-- This is where child views will insert their content -->
</main>

<footer>
    <p>&copy; {{ date('Y') }} My Laravel App</p>
</footer>

<script src="{{ asset('js/app.js') }}"></script> <!-- Link to your JS -->
</body>
</html>
