<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Bola - Frontend</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-dark text-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary border-bottom border-secondary">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="#"><i class="bi bi-dribbble"></i> TOKO BOLA</a>
            <div class="ms-auto">
                <!-- Tombol ke Halaman Login sesuai tugas -->
                <a href="{{ url('/login') }}" class="btn btn-success fw-bold px-4">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <div class="container my-5 py-5 text-center">
        <span class="badge bg-success mb-3 px-3 py-2">OFFICIAL STORE 2026</span>
        <h1 class="display-3 fw-bold text-white">Selamat Datang di Toko Bola</h1>
        <p class="lead text-secondary max-w-lg mx-auto">Pusat perlengkapan sepak bola dan futsal original terlengkap.</p>
        
        <div class="row mt-5 justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card bg-secondary text-white border-0 shadow">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Sepatu Bola">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Nike Air Zoom Mercurial</h5>
                        <p class="card-text text-success fw-bold">Rp 2.499.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-secondary text-white border-0 shadow">
                    <img src="https://images.unsplash.com/photo-1511886929837-354d827aae26?auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Sepatu Adidas">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Adidas Predator Accuracy</h5>
                        <p class="card-text text-success fw-bold">Rp 2.380.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>