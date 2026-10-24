<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Bola - Frontend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(180deg, #101a27 0%, #1b2a3a 100%);
            min-height: 100vh;
            color: #f8fafc;
        }
        .navbar-custom {
            background: rgba(92, 96, 106, 0.9);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(8px);
        }
        .nav-btn {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: #fff;
            border-radius: 10px;
        }
        .nav-btn:hover {
            background: rgba(255,255,255,0.1);
        }
        .product-card {
            border: 0;
            background: rgba(255,255,255,0.04);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(0,0,0,0.35);
        }
        .product-card img {
            height: 300px;
            object-fit: cover;
            width: 100%;
        }
        .product-footer {
            background: rgba(148,163,184,0.16);
            padding: 16px 18px;
        }
        .hero-tag {
            background: #16a34a;
            border-radius: 8px;
            font-size: 12px;
            letter-spacing: 1px;
            padding: 8px 12px;
            display: inline-block;
            font-weight: 700;
            margin-bottom: 18px;
        }
        .hero-heading {
            font-size: clamp(2.8rem, 5vw, 6rem);
            font-weight: 800;
            letter-spacing: -0.05em;
            margin-bottom: 10px;
        }
        .hero-sub {
            color: #cbd5e1;
            font-size: 1.25rem;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="#"><i class="bi bi-dribbble"></i> TOKO BOLA</a>
            <div class="ms-auto d-flex align-items-center gap-2 flex-wrap">
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ url('/dashboard') }}" class="btn btn-sm nav-btn px-3"><i class="bi bi-speedometer2"></i> Admin</a>
                    @endif

                    @if (Auth::user()->role === 'kasir')
                        <a href="{{ url('/kasir') }}" class="btn btn-sm nav-btn px-3"><i class="bi bi-cash-stack"></i> Kasir</a>
                    @endif

                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('products.index') }}" class="btn btn-sm nav-btn px-3"><i class="bi bi-bag-check"></i> Produk</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm px-3"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success fw-bold px-4"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container py-5 text-center">
        <div class="hero-tag">OFFICIAL STORE 2026</div>
        <h1 class="hero-heading">Selamat Datang di Toko Bola</h1>
        <p class="hero-sub">Pusat perlengkapan sepak bola dan futsal original terlengkap.</p>

        <div class="row mt-4 justify-content-center g-4">
            <div class="col-md-5">
                <div class="product-card text-white">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80" alt="Nike Air Zoom Mercurial">
                    <div class="product-footer text-center">
                        <h5 class="fw-bold mb-2">Nike Air Zoom Mercurial</h5>
                        <p class="text-success fw-bold mb-0">Rp 2.499.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="product-card text-white">
                    <img src="https://images.unsplash.com/photo-1511886929837-354d827aae26?auto=format&fit=crop&w=800&q=80" alt="Adidas Predator Accuracy">
                    <div class="product-footer text-center">
                        <h5 class="fw-bold mb-2">Adidas Predator Accuracy</h5>
                        <p class="text-success fw-bold mb-0">Rp 2.380.000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>