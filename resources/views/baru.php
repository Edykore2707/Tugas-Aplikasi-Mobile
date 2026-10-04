<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Laravel</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        nav {
            background: #ff2d20;
            padding: 20px 50px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav h2 {
            font-size: 25px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .hero {
            min-height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: white;
        }

        .hero h1 {
            font-size: 50px;
            color: #ff2d20;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 20px;
            color: #555;
            margin-bottom: 25px;
        }

        .btn {
            background: #ff2d20;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
        }

        footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>

    <nav>
        <h2>Laravel Web</h2>

        <div>
            <a href="/">Home</a>
            <a href="#">Tentang</a>
            <a href="#">Kontak</a>
        </div>
    </nav>

    <section class="hero">
        <div>
            <h1>Selamat Datang</h1>
            <p>Website pertama saya menggunakan Laravel</p>

            <a href="#" class="btn">Mulai Sekarang</a>
        </div>
    </section>

    <footer>
        <p>© 2026 Laravel Web | Praktikum Pemrograman Web</p>
    </footer>

</body>
</html>