<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Toko Bola</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/js/app.js'])
    <style>
        :root {
            --bg: #07111f;
            --bg-soft: #0d1b2a;
            --panel: rgba(13, 27, 42, 0.9);
            --panel-strong: #112033;
            --panel-alt: rgba(17, 32, 48, 0.92);
            --border: rgba(148, 163, 184, 0.18);
            --border-strong: rgba(148, 163, 184, 0.28);
            --text: #edf3ff;
            --muted: #94a3b8;
            --success: #22c55e;
            --success-strong: #16a34a;
            --primary: #38bdf8;
            --warning: #fbbf24;
            --danger: #f87171;
            --shadow: 0 22px 45px rgba(2, 6, 23, 0.45);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at top, rgba(34, 197, 94, 0.12), transparent 30%),
                linear-gradient(180deg, #07111f 0%, #0b1628 100%);
            color: var(--text);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(7, 17, 31, 0.82);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        .topbar .container-fluid {
            max-width: 1600px;
            padding: 0.95rem 1.5rem;
        }

        .brand-mark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.22), rgba(56, 189, 248, 0.18));
            border: 1px solid rgba(34, 197, 94, 0.25);
            color: var(--success);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
        }

        .brand-text {
            font-size: 1.05rem;
            letter-spacing: -0.02em;
        }

        .brand-text .mini {
            color: rgba(255,255,255,0.62);
            font-weight: 500;
        }

        .topbar-actions {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .notif-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border: 1px solid var(--border);
            background: rgba(148, 163, 184, 0.06);
            border-radius: 12px;
            color: var(--text);
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .notif-btn:hover {
            background: rgba(56, 189, 248, 0.08);
            border-color: rgba(56, 189, 248, 0.25);
        }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -3px;
            min-width: 18px;
            height: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
            border-radius: 999px;
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            color: #fff;
            font-size: 0.64rem;
            font-weight: 700;
            border: 2px solid rgba(7, 17, 31, 1);
        }

        .user-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.5rem 0.9rem;
            background: rgba(148, 163, 184, 0.06);
            border: 1px solid var(--border);
            border-radius: 999px;
            color: var(--text);
            font-size: 0.85rem;
            font-weight: 600;
        }

        .user-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #22c55e, #38bdf8);
            color: white;
            font-size: 0.7rem;
        }

        .notif-panel {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            width: min(360px, 86vw);
            background: rgba(9, 17, 28, 0.96);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 30px 60px rgba(2, 6, 23, 0.55);
            padding: 0.8rem 0;
            display: none;
            z-index: 1200;
        }

        .notif-panel.show {
            display: block;
        }

        .notif-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.2rem 1rem 0.8rem;
            border-bottom: 1px solid var(--border);
        }

        .notif-header h6 {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .notif-list {
            max-height: 320px;
            overflow-y: auto;
        }

        .notif-item {
            display: flex;
            gap: 0.75rem;
            padding: 0.9rem 1rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.08);
            transition: background 0.2s ease;
        }

        .notif-item:hover {
            background: rgba(148, 163, 184, 0.04);
        }

        .notif-icon {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(34, 197, 94, 0.12);
            color: #9ae6b4;
            flex-shrink: 0;
        }

        .notif-text {
            flex: 1;
            min-width: 0;
        }

        .notif-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text);
            margin: 0;
        }

        .notif-message {
            margin: 0.2rem 0 0;
            font-size: 0.76rem;
            color: var(--muted);
            line-height: 1.5;
        }

        .notif-time {
            font-size: 0.68rem;
            color: rgba(148, 163, 184, 0.9);
        }

        .logout-btn {
            border-radius: 12px;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fecaca;
            padding: 0.55rem 0.9rem;
            font-weight: 600;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #fff1f2;
        }

        .app-shell {
            max-width: 1600px;
            margin: 1.5rem auto 0;
            padding: 0 1.5rem 2rem;
        }

        .sidebar {
            background: rgba(12, 21, 35, 0.9);
            border: 1px solid var(--border);
            border-radius: 26px;
            box-shadow: var(--shadow);
            padding: 1rem 0.8rem;
            position: sticky;
            top: 96px;
            min-height: calc(100vh - 130px);
        }

        .sidebar-header {
            padding: 0.8rem 0.85rem 1.2rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 0.9rem;
        }

        .sidebar-title {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            color: var(--text);
            font-size: 0.8rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 700;
            opacity: 0.7;
        }

        .sidebar .nav {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: var(--muted);
            border-radius: 14px;
            padding: 0.85rem 0.9rem;
            font-size: 0.96rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            background: rgba(148, 163, 184, 0.07);
            color: var(--text);
            transform: translateX(2px);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, rgb(34, 197, 94) 0%, rgb(22, 163, 74) 100%);
            box-shadow: 0 12px 25px rgba(34, 197, 94, 0.28);
        }

        .content-area {
            min-width: 0;
            padding-bottom: 1rem;
        }

        .card-dark {
            background: linear-gradient(180deg, rgba(17, 28, 43, 0.96), rgba(11, 19, 31, 0.94));
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: var(--shadow);
        }

        .btn-modern {
            border-radius: 14px;
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid transparent;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 30px rgba(14, 116, 144, 0.2);
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .page-header h2 {
            margin: 0;
            font-size: clamp(1.6rem, 2vw, 2.2rem);
            letter-spacing: -0.04em;
        }

        .page-header p {
            margin: 0.4rem 0 0;
            color: var(--muted);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            padding: 1.4rem 1.2rem;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            top: -30px;
            right: -30px;
            width: 120px;
            height: 120px;
            background: rgba(148, 163, 184, 0.06);
            border-radius: 50%;
        }

        .stat-card .label {
            color: rgba(148, 163, 184, 0.9);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.9rem;
            position: relative;
            z-index: 1;
        }

        .stat-card .value {
            position: relative;
            z-index: 1;
            font-weight: 800;
            font-size: clamp(1.7rem, 2vw, 2.5rem);
            letter-spacing: -0.06em;
        }

        .stat-card .icon-wrap {
            position: relative;
            z-index: 1;
            width: 50px;
            height: 50px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .hero-card {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, 0.14);
        }

        .hero-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(34,197,94,0.14), transparent 52%, rgba(59,130,246,0.12));
            pointer-events: none;
        }

        .hero-card > * {
            position: relative;
            z-index: 1;
        }

        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.5rem 0.8rem;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 700;
            border: 1px solid rgba(34,197,94,0.3);
            background: rgba(34,197,94,0.12);
            color: #8ef0b2;
        }

        .quick-action {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.1rem;
            border-radius: 18px;
            border: 1px solid var(--border);
            background: rgba(148, 163, 184, 0.03);
            color: var(--text);
            transition: all 0.2s ease;
        }

        .quick-action:hover {
            border-color: rgba(56, 189, 248, 0.4);
            background: rgba(56, 189, 248, 0.06);
            transform: translateY(-2px);
        }

        .quick-action-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .text-soft {
            color: var(--muted);
        }

        @media (max-width: 991.98px) {
            .app-shell {
                padding: 0 1rem 2rem;
            }

            .sidebar {
                position: static;
                min-height: auto;
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 575.98px) {
            .topbar .container-fluid {
                padding-left: 0.9rem;
                padding-right: 0.9rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <nav class="topbar navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-3 text-success" href="{{ url('/dashboard') }}">
                <span class="brand-mark"><i class="bi bi-speedometer2"></i></span>
                <span class="brand-text">Dashboard Admin <span class="mini">- Toko Bola</span></span>
            </a>

            <div class="topbar-actions">
                <div class="position-relative">
                    <button type="button" class="notif-btn" id="global-notification-btn" aria-label="Notifikasi">
                        <i class="bi bi-bell-fill"></i>
                        <span class="notif-badge" id="notification-count">3</span>
                    </button>

                    <div class="notif-panel" id="notification-panel" aria-live="polite">
                        <div class="notif-header">
                            <h6>Notifikasi</h6>
                            <button type="button" class="btn btn-link btn-sm text-success p-0" id="mark-all-read">Baca semua</button>
                        </div>
                        <div class="notif-list" id="notification-list">
                            <div class="notif-item">
                                <div class="notif-icon"><i class="bi bi-cart-check-fill"></i></div>
                                <div class="notif-text">
                                    <p class="notif-title">Pesanan baru</p>
                                    <p class="notif-message">Order #1042 berhasil dibuat dengan total Rp 250.000</p>
                                    <div class="notif-time">2 menit yang lalu</div>
                                </div>
                            </div>
                            <div class="notif-item">
                                <div class="notif-icon"><i class="bi bi-box-seam"></i></div>
                                <div class="notif-text">
                                    <p class="notif-title">Stok menipis</p>
                                    <p class="notif-message">Produk Sepatu Futsal A12 tersisa 3 item</p>
                                    <div class="notif-time">25 menit yang lalu</div>
                                </div>
                            </div>
                            <div class="notif-item">
                                <div class="notif-icon"><i class="bi bi-graph-up-arrow"></i></div>
                                <div class="notif-text">
                                    <p class="notif-title">Laporan harian</p>
                                    <p class="notif-message">Penjualan hari ini naik 12% dibanding kemarin</p>
                                    <div class="notif-time">1 jam yang lalu</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user-pill">
                    <span class="user-avatar"><i class="bi bi-person-fill"></i></span>
                    <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn logout-btn">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="app-shell">
        <div class="row g-4 align-items-start">
            <div class="col-lg-2 col-md-12">
                <aside class="sidebar">
                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            <i class="bi bi-columns-gap"></i>
                            <span>Navigasi</span>
                        </div>
                    </div>
                    <div class="nav flex-column">
                        <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('products.index') }}" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
                            <i class="bi bi-bag-check-fill"></i>
                            <span>Data Produk</span>
                        </a>
                        <a href="{{ route('kasir.index') }}" class="nav-link {{ request()->is('kasir*') ? 'active' : '' }}">
                            <i class="bi bi-cart-fill"></i>
                            <span>Transaksi</span>
                        </a>
                        <a href="#" class="nav-link {{ request()->is('pengguna*') ? 'active' : '' }}">
                            <i class="bi bi-people-fill"></i>
                            <span>Pengguna</span>
                        </a>
                    </div>
                </aside>
            </div>

            <div class="col-lg-10 col-md-12">
                <main class="content-area">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notificationList = document.getElementById('notification-list');
            const notificationCount = document.getElementById('notification-count');
            const notificationPanel = document.getElementById('notification-panel');
            const notificationButton = document.getElementById('global-notification-btn');

            function addNotificationItem(title, message, timeText = 'baru saja') {
                if (!notificationList) return;

                const item = document.createElement('div');
                item.className = 'notif-item';
                item.innerHTML = `
                    <div class="notif-icon"><i class="bi bi-bell-fill"></i></div>
                    <div class="notif-text">
                        <p class="notif-title">${title}</p>
                        <p class="notif-message">${message}</p>
                        <div class="notif-time">${timeText}</div>
                    </div>
                `;

                notificationList.prepend(item);

                if (notificationCount) {
                    const current = Number(notificationCount.textContent) || 0;
                    notificationCount.textContent = current + 1;
                }
            }

            function showOrderToast(event) {
                const payload = event || {};
                const orderId = payload.order_id || payload.order?.id || 'Unknown';
                const total = payload.total || payload.order?.total_amount || 0;
                const buyer = payload.user_name || payload.user?.name || 'Pelanggan';

                const totalLabel = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(total);

                addNotificationItem(
                    'Pesanan baru',
                    `Order #${orderId} dari ${buyer} dengan total ${totalLabel}`,
                    'baru saja'
                );

                const toast = document.createElement('div');
                toast.className = 'position-fixed top-0 end-0 m-3 rounded-4 shadow-lg border';
                toast.style.zIndex = '9999';
                toast.style.width = '340px';
                toast.style.maxWidth = 'calc(100vw - 32px)';
                toast.style.background = 'linear-gradient(135deg, rgba(16,185,129,0.95), rgba(17,24,39,0.95))';
                toast.style.borderColor = 'rgba(16,185,129,0.4)';
                toast.style.color = '#f8fafc';
                toast.style.padding = '16px 18px';
                toast.innerHTML = `
                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-3 p-2" style="background: rgba(16,185,129,0.2); color: #34d399; font-size: 1.2rem;">
                            <i class="bi bi-bell-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold mb-1" style="font-size: 1rem;">🔔 Pesanan Baru Masuk!</div>
                            <div class="small text-light">ID Pesanan: #${orderId}</div>
                            <div class="small text-light">Total: ${totalLabel}</div>
                            <div class="small text-light">Pemesan: ${buyer}</div>
                        </div>
                    </div>
                `;

                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 6000);
            }

            function initEchoListener() {
                if (typeof window.Echo !== 'undefined') {
                    const adminChannel = window.Echo.private('admin.orders');

                    adminChannel.listen('OrderPlaced', (event) => {
                        console.log('Order Placed Event Captured:', event);
                        showOrderToast(event);
                    });

                    adminChannel.listen('.order.placed', (event) => {
                        console.log('Order Placed Event Captured (.order.placed):', event);
                        showOrderToast(event);
                    });

                    window.Echo.private('user.{{ auth()->id() }}')
                        .listen('.order.placed', (event) => {
                            console.log('Order Placed Event Captured (user fallback):', event);
                            showOrderToast(event);
                        });
                } else {
                    setTimeout(initEchoListener, 300);
                }
            }

            initEchoListener();

            const testButton = document.getElementById('test-order-alert');
            if (testButton) {
                testButton.addEventListener('click', function () {
                    showOrderToast({
                        order_id: 'TEST-' + Date.now(),
                        total: 250000,
                        user_name: 'Testing Admin'
                    });
                });
            }

            if (notificationButton) {
                notificationButton.addEventListener('click', function () {
                    if (notificationPanel) {
                        notificationPanel.classList.toggle('show');
                    }
                });
            }

            if (document.getElementById('mark-all-read')) {
                document.getElementById('mark-all-read').addEventListener('click', function () {
                    if (notificationCount) {
                        notificationCount.textContent = '0';
                    }
                    if (notificationList) {
                        notificationList.innerHTML = `
                            <div class="notif-item">
                                <div class="notif-icon"><i class="bi bi-check-circle-fill"></i></div>
                                <div class="notif-text">
                                    <p class="notif-title">Semua sudah dibaca</p>
                                    <p class="notif-message">Tidak ada notifikasi baru saat ini.</p>
                                    <div class="notif-time">Sekarang</div>
                                </div>
                            </div>
                        `;
                    }
                });
            }

            document.addEventListener('click', function (event) {
                if (!event.target.closest('#global-notification-btn') && !event.target.closest('#notification-panel')) {
                    if (notificationPanel) {
                        notificationPanel.classList.remove('show');
                    }
                }
            });
        });
    </script>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
