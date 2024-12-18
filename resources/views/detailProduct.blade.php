<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layout</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .container1 {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            flex: 0 0 200px;
            background-color: #a15252;
            color: #fff;
            min-height: 100vh;
            padding-top: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #7e3b3b;
            border-radius: 5px;
        }

        .sidebar ul li form button {
            width: 100%;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
        }

        .sidebar ul li form button:hover {
            background-color: #7e3b3b;
            border-radius: 5px;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .navbar {
            background-color: #bea2a2;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            height: 130px;
        }

        .navbar .logo img {
            height: 170px;
            width: auto;
            margin-right: 10px;
        }

        .navbar .nav-links a {
            color: #fff;
            margin-left: auto;
            margin-right: 10px;
            text-decoration: none;
            font-size: 16px;
        }

        .navbar .nav-links a:hover {
            text-decoration: underline;
        }

        .navbar .nav-links .social-icon {
            font-size: 20px;
        }

        /* Styling for the Product Page */
        .product-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: row;
            gap: 40px;
            padding: 40px;
        }

        .product-image {
            flex: 1;
            text-align: center;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
        }

        .product-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .product-price {
            font-size: 24px;
            font-weight: bold;
            color: #b28b42;
            margin-bottom: 20px;
        }

        .product-actions {
            display: flex;
            gap: 10px;
        }

        .product-actions button {
            flex: 1;
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .wishlist-button {
            background-color: #e8e8e8;
            color: #333;
        }

        .wishlist-button:hover {
            background-color: #d6d6d6;
        }

        .cart-button {
            background-color: #333;
            color: #fff;
        }

        .cart-button:hover {
            background-color: #555;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logo/logo1.png') }}" alt="Logo">
        </div>
        <div class="nav-links">
            <a href="{{ route('products.buyers') }}">Dashboard</a>
            <a href="https://www.instagram.com/rewear.coo?utm_source=ig_web_button_share_sheet&igshid=ZDNlZDc0MzIxNw=="
                target="_blank" class="social-icon">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </nav>

    <!-- Sidebar and Content -->
    <div class="container1">
        <nav class="sidebar">
            <ul>
                <li><a href="{{ route('products.buyers') }}">Dashboard</a></li>
                <li><a href="{{ route('category.index') }}">Category</a></li>
                <li><a href="{{ route('product.index') }}">Product</a></li>
                <li><a href="{{ route('favorites.index') }}">Favorite Product</a></li>
                <li><a href="{{ route('mix-match.index') }}">Mix&Match Product</a></li>
                <li>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
        <main class="content">
            <!-- Product Page -->
            <div class="product-container">
                <!-- Product Image -->
                <div class="product-image">
                    <img src="https://via.placeholder.com/500" alt="152 Series Watch">
                </div>

                <!-- Product Details -->
                <div class="product-details">
                    <!-- Removed the breadcrumb section -->
                    <!-- Removed the 'Designed by...' text -->
                    <h1 class="product-title">152 Series Watch</h1>
                    <p class="product-description">
                        The Uniform Wares Series 152 Watch is a refined and updated take on the classic dress wristwatch. The thin silhouette has been pared down with a smaller case design, and the round face is framed by an angular base that helps balance the roundness of the case.
                    </p>
                    <div class="product-price">$360.00</div>
                    <div class="product-actions">
                        <button class="wishlist-button">Add to Wishlist</button>
                        <button class="cart-button">Add to Cart</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>
