<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Toko Bola</title>
    
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Font: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            min-height: 100vh;
        }

        /* Top Navbar Dark */
        .navbar-custom {
            background: #1e293b;
            border-bottom: 1px solid #334155;
        }

        /* Sidebar Styling Dark */
        .sidebar {
            background: #1e293b;
            border: 1px solid #334155;
            min-height: calc(100vh - 100px);
            border-radius: 16px;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            font-weight: 500;
            padding: 12px 18px;
            border-radius: 10px;
            margin-bottom: 6px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover {
            color: #ffffff;
            background: #334155;
        }

        .sidebar .nav-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        /* Card Container Dark */
        .card-dark {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
        }

        .btn-modern {
            border-radius: 10px;
            font-weight: 600;
            transition: transform 0.2s ease;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top py-3 shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/dashboard') }}">
                <i class="bi bi-speedometer2 text-success fs-4"></i>
                <span>Dashboard Admin <span class="text-success">- Toko Bola</span></span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4 mt-4">
        <div class="row g-4">
            <!-- Sidebar Navigation -->
            <div class="col-lg-2">
                <div class="sidebar p-3 shadow-sm">
                    <div class="nav flex-column">
                        <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('products.index') }}" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
                            <i class="bi bi-bag-check-fill me-2"></i> Data Produk
                        </a>
                        <a href="{{ route('kasir.index') }}" class="nav-link {{ request()->is('kasir*') ? 'active' : '' }}">
                            <i class="bi bi-cart-fill me-2"></i> Transaksi
                        </a>
                        <a href="#" class="nav-link {{ request()->is('pengguna*') ? 'active' : '' }}">
                            <i class="bi bi-people-fill me-2"></i> Pengguna
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-10">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>