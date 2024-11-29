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

            overflow: hidden; /* Pastikan elemen tidak meluap */
            height: 130px; /* Tetapkan tinggi navbar tetap */

            

        }

        .navbar .logo {
            max-width: 100%; /* Memastikan gambar tidak melampaui area elemen induk */

            height: auto;
        }

        .navbar img {
            height: 200px; /* Perbesar logo tanpa memengaruhi navbar */
            width: auto;
            transform: translateY(-20px); /* Sesuaikan posisi logo jika terlalu besar */
        }



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

            position: relative;
            left: -50px; /* Pindahkan lebih ke kiri */
            top: -50px; /* Pindahkan sedikit ke atas */


        }

        .navbar .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>
<body>
    <!-- Navbar section -->
    <nav class="navbar">
        <div class="logo">

            <img src="{{ asset('images/logo/logo1.png') }}" alt="Logo">
            
        </div>
        <div class="nav-links">
            <a href="{{ route('products.buyers') }}">Dashboard</a>
            <a href="https://www.instagram.com/rewear.coo?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
                <i class="fab fa-instagram" style="font-size: 20px;"></i>
            </a>



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

                <ul>
                    
                    <li><a href="{{ route('products.buyers') }}">Dashboard</a></li>
                    <li><a href="{{ route('category.index') }}">Category</a></li>
                    <li><a href="{{ route('product.index') }}">Product</a></li>
                    <li><a href="{{ route('favorites.index') }}">Favorite Product</a></li>
                    <li><a href="{{ route('mix-match.index') }}">Mix&Match Product</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
                

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