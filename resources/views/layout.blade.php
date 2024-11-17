<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layout</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .container1 {
            display: flex;
            min-height: 100vh; /* Pastikan container memiliki tinggi minimal 100% dari tampilan */
        }

        .sidebar {
            flex: 0 0 200px;
            background-color: #a15252;
            color: #fff;
            min-height: 100vh; /* Tambahkan tinggi minimum 100% dari tinggi viewport */
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0; /* Pastikan tidak ada margin tambahan */
        }

        .sidebar ul li {
            padding: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar ul li a:hover {
            background-color: #555;
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
            
        }

        .navbar .logo {
            max-width: 100%; /* Memastikan gambar tidak melampaui area elemen induk */
            height: auto;    /* Menjaga rasio aspek gambar */
            width: 00px;    /* Ukuran default logo */
        }

        .navbar img {
            height: 100px; /* Sesuaikan tinggi untuk logo yang lebih besar */
            width: auto;   /* Pertahankan proporsi gambar */
        }

        .navbar .nav-links a {
            color: #fff;
            margin: 10px;
            text-decoration: none;
        }

        .navbar .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Navbar section -->
    <nav class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logo1.png') }}" alt="Logo">
            
        </div>
        <div class="nav-links">
            <a href="#">Dashboard</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </div>
    </nav>

    <div class="container1">
        <nav class="sidebar">
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Category</a></li>
                <li><a href="#">Product</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </nav>
        <main class="content">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>