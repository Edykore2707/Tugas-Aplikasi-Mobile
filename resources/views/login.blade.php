<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Toko Bola</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #06101f, #0b1d30, #07101f);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: #111a2e;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        /* LOGO POLIJE */
        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            background: white;
            border-radius: 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            box-shadow: 0 10px 35px rgba(22, 199, 154, 0.35);

            overflow: hidden;
            transition: 0.3s;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }

        .title span {
            color: #16c79a;
        }

        .subtitle {
            text-align: center;
            color: #8c98aa;
            margin-bottom: 30px;
        }

        .form-label {
            color: #dce3ec;
            font-weight: 600;
        }

        .form-control {
            background: #0b1425;
            border: 1px solid #26344a;
            color: white;
            padding: 13px 15px;
            border-radius: 10px;
        }

        .form-control:focus {
            background: #0b1425;
            color: white;
            border-color: #16c79a;
            box-shadow: 0 0 0 0.2rem rgba(22, 199, 154, 0.15);
        }

        .form-control::placeholder {
            color: #66758a;
        }

        .remember {
            color: #8c98aa;
            font-size: 14px;
        }

        .forgot {
            color: #16c79a;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot:hover {
            color: #20e0ad;
        }

        .btn-login {
            width: 100%;
            border: none;
            padding: 13px;
            border-radius: 10px;
            background: #16c79a;
            color: #07101f;
            font-weight: bold;
            font-size: 16px;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #20e0ad;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(22, 199, 154, 0.3);
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #8c98aa;
            text-decoration: none;
            font-size: 14px;
        }

        .back:hover {
            color: #16c79a;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #59677a;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <!-- LOGO POLIJE -->
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Logo">
        </div>

        <!-- JUDUL -->
        <div class="title">
            TOKO<span>BOLA</span>
        </div>

        <div class="subtitle">
            Silakan login untuk melanjutkan
        </div>

        <!-- FORM LOGIN -->
        <form action="{{ url('/login') }}" method="POST">

            @csrf

            <!-- EMAIL -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="bi bi-envelope"></i>
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan email"
                    required
                >
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="bi bi-lock"></i>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <!-- REMEMBER & FORGOT -->
            <div class="d-flex justify-content-between align-items-center">

                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="remember"
                        name="remember"
                    >

                    <label class="form-check-label remember" for="remember">
                        Ingat saya
                    </label>
                </div>

                <a href="#" class="forgot">
                    Lupa password?
                </a>

            </div>

            <!-- TOMBOL LOGIN -->
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Login
            </button>

        </form>

        <!-- KEMBALI -->
        <a href="/" class="back">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Toko Bola
        </a>

        <!-- FOOTER -->
        <div class="footer">
            © 2026 Toko Bola
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>