<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rewear.coo Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Importing fonts from Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        /* Resetting */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #ecf0f3;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .wrapper {
            max-width: 300px;
            min-height: 450px;
            padding: 30px;
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 10px 10px 20px #cbced1, -10px -10px 20px #fff;
        }

        
        .logo img {
            width: 70%;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0px 0px 3px #D47697,

                0px 0px 0px 2px #D47697,


                0px 0px 0px 2px #ac1e44,
                0px 0px 0px 2px #c72c48,

                8px 8px 15px #D47697,
                -8px -8px 15px #D47697;
                display: block; /* Ubah gambar menjadi elemen blok */
                margin: 0 auto; /* Posisi tengah secara horizontal */
                margin-bottom: 20px;
}


        .wrapper .name {
            text-align: center;
            font-weight: 600;
            font-size: 1.3rem;
            letter-spacing: 1.2px;
            color: #555;
            margin-bottom: 20px;
        }

        .wrapper .form-field {
            width: 85%;
            margin: 10px auto;
            position: relative;
        }

        .wrapper .form-field input {
            width: 100%;
            padding: 10px;
            padding-left: 35px;
            border: none;
            outline: none;
            background: #ecf0f3;
            font-size: 1rem;
            color: #666;
            border-radius: 20px;
            box-shadow: inset 5px 5px 8px #cbced1, inset -5px -5px 8px #fff;
        }

        .wrapper .form-field .fas {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #555;
        }

        .wrapper .btn {
            display: block;
            width: 85%;
            margin: 20px auto;
            height: 40px;

            background-color: #A82451;


            background-color: #ac1e44;
            background-color:#ac1e44;

            color: #fff;
            border: none;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 3px 3px 6px #b1b1b1, -3px -3px 6px #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .wrapper .btn:hover {

            background-color: #039BE5;

            background-color: #722f37;
            background-color: #7c0a02;


        }

        .wrapper .text-center {
            text-align: center;
        }

        .wrapper .text-center a {
            text-decoration: none;
            font-size: 0.85rem;

            color: #03A9F4;
        }

        .wrapper .text-center a:hover {
            color: #039BE5;

            color: #9f1d35;
        }

        .wrapper .text-center a:hover {
            color: #722f37;
            color: #ac1e44;
        }

        .wrapper .text-center a:hover {
            color: #7c0a02;

        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <img src="images/logoo.jpg" alt="Logo">
        </div>
        <div class="name">
            Preloved B2J
        </div>
        <form>
            <div class="form-field">
                <span class="fas fa-user"></span>
                <input type="text" name="userName" id="userName" placeholder="Username">
            </div>
            <div class="form-field">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <button type="submit" class="btn">Login</button>             
        </form>
        <div class="text-center">
            <a href="#">Forget password?</a> or <a href="#">Sign up</a>
        </div>
    </div>
</body>
</html>
