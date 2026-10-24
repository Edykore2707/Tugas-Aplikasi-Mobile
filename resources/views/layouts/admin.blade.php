<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Toko Bola</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0f172a;
            --panel: #111827;
            --panel-2: #1f2937;
            --border: rgba(148,163,184,0.2);
            --text: #f8fafc;
            --muted: #94a3b8;
            --success: #10b981;
            --primary: #38bdf8;
            --warning: #fbbf24;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(180deg, #0f172a 0%, #111827 100%);
            color: var(--text);
            min-height: 100vh;
        }
        .navbar-custom {
            background: rgba(17,24,39,0.92);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(8px);
        }
        .sidebar {
            background: rgba(17,24,39,0.9);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 16px 12px;
            min-height: calc(100vh - 120px);
            position: sticky;
            top: 88px;
        }
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            color: var(--muted);
            font-weight: 600;
            padding: 12px 14px;
            border-radius: 12px;
            transition: all 0.2s ease;
            margin-bottom: 6px;
        }
        .sidebar .nav-link:hover {
            background: rgba(148,163,184,0.08);
            color: var(--text);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 10px 25px rgba(16,185,129,0.25);
        }
        .card-dark {
            background: rgba(17,24,39,0.9);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.18);
        }
        .btn-modern {
            border-radius: 12px;
            font-weight: 600;
            transition: transform 0.2s ease;
        }
        .btn-modern:hover {
            transform: translateY(-2px);
        }
        .logout-btn {
            border-radius: 12px;
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.2);
            color: #fecaca;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top py-3 shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-success" href="{{ url('/dashboard') }}">
                <i class="bi bi-speedometer2 fs-4"></i>
                <span>Dashboard Admin <span class="text-white-50">- Toko Bola</span></span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn logout-btn btn-sm px-3">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4 mt-4">
        <div class="row g-4">
            <div class="col-lg-2">
                <div class="sidebar">
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

            <div class="col-lg-10">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
