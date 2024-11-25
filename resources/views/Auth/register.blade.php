<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <style>
        /* General Styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #FFF0F5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container */
        .container {
            display: flex;
            width: 800px;
            height: 555px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }

        /* Left Panel */
        .left-panel {
            flex: 1;
            background: url('{{ asset('images/12.jpeg') }}') no-repeat center center/cover;
            color: black;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Right Panel */
        .right-panel {
            flex: 1;
            background: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-panel h2 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            margin-bottom: 15px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .join-btn {
            background: black;
            color: white;
            margin-bottom: 15px;
        }

        /* Google and Apple Button Style */
        .google-btn, .apple-btn {
            margin-bottom: 10px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 12px;
        }

        .google-btn img, .apple-btn img {
            width: 24px; /* Adjust the size of the logos */
            height: auto;
            margin-right: 10px; /* Space between logo and text */
        }

        .google-btn span, .apple-btn span {
            font-size: 16px;
            color: black;
        }

        .google-btn {
            background-color: #4285F4; /* Google blue */
            color: white;
        }

        .apple-btn {
            background-color: black;
            color: white;
        }

        /* Success Message */
        .message {
            display: none; /* Initially hidden */
            background-color:  #FFF0F5;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }

        .message button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .message button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left-panel">
        <!-- Optional content for left panel -->
    </div>
    <div class="right-panel">
        <h2>Create Account</h2>

        <!-- Menampilkan pesan error -->
        @if ($errors->any())
            <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="registrationForm" method="POST" action="{{ route('register') }}">
            @csrf <!-- Token CSRF -->
            <input type="text" id="nama_lengkap" name="name" placeholder="Nama" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="text" id="no_hp" name="phone" placeholder="Telp" required>
            
    <input type="text" id="address" name="address" placeholder="Alamat" required>

    <input type="text" id="username" name="username" placeholder="Username" required>

            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
            
            <button type="submit" class="join-btn">Register</button>
           
        </form>
        
        <div id="successMessage" class="message" style="display: none;">
            <p>Registrasi berhasil! Selamat, aktivasi akun Anda berhasil.</p>
            <button onclick="redirectToLogin()">Login</button>
        </div>
    </div>
</div>

    <script>
        function submitForm() {
            // Validate form
            const form = document.getElementById('registrationForm');
            if (form.checkValidity()) {
                // Hide form and title
                form.style.display = 'none';
                document.querySelector('.right-panel h2').style.display = 'none';

                // Show success message
                document.getElementById('successMessage').style.display = 'block';
            } else {
                // If form is not valid, show the built-in validation messages
                form.reportValidity();
            }
        }

        function redirectToLogin() {
            // Redirect to the login page (change this URL if needed)
            window.location.href = '/login';
        }
    </script>
</body>
</html>
