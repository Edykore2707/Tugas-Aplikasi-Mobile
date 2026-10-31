<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @auth
        <!-- Real-time Event Listener (Laravel Reverb & Echo) -->
        <script>
            window.addEventListener('load', function () {
                const userId = "{{ auth()->id() }}";

                // Fungsi untuk memasang listener setelah Echo dipastikan siap
                function initEchoListener() {
                    if (window.Echo) {
                        window.Echo.private(`user.${userId}`)
                            .listen('.order.placed', (e) => {
                                alert(`🔔 Pesanan Baru Masuk!\nID Pesanan: #${e.order_id}\nTotal: Rp ${Number(e.total).toLocaleString('id-ID')}\nPemesan: ${e.user_name}`);
                                console.log('Real-Time Order Event Received:', e);
                            });
                        console.log('✅ Real-time listener terhubung ke channel: user.' + userId);
                    } else {
                        // Cek kembali setiap 100ms jika Echo belum selesai dimuat
                        setTimeout(initEchoListener, 100);
                    }
                }

                initEchoListener();
            });
        </script>
        @endauth
    </body>
</html>