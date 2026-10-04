<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Bola - Store Perlengkapan Sepakbola & Futsal Original</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-emerald-500 selection:text-slate-950">

    <!-- NAVBAR -->
    <nav class="bg-slate-900/90 backdrop-blur-md fixed w-full z-50 top-0 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="#" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 bg-gradient-to-tr from-emerald-600 to-teal-400 rounded-2xl flex items-center justify-center font-bold text-slate-950 shadow-lg shadow-emerald-500/30 group-hover:scale-105 transition duration-300">
                        <i class="fa-solid fa-futbol text-2xl text-slate-950"></i>
                    </div>
                    <div>
                        <span class="font-extrabold text-2xl tracking-wider text-emerald-400">TOKO<span class="text-white">BOLA</span></span>
                        <span class="block text-[10px] text-slate-400 font-semibold tracking-widest uppercase">Official Store</span>
                    </div>
                </a>

                <!-- Nav Links -->
                <div class="hidden md:flex space-x-8 text-sm font-medium">
                    <a href="#" class="text-emerald-400 font-semibold hover:text-emerald-300 transition">Beranda</a>
                    <a href="#kategori" class="text-slate-300 hover:text-emerald-400 transition">Kategori</a>
                    <a href="#produk" class="text-slate-300 hover:text-emerald-400 transition">Produk Populer</a>
                    <a href="#promo" class="text-slate-300 hover:text-emerald-400 transition">Promo</a>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center space-x-4">
                    <button class="relative p-2.5 text-slate-300 hover:text-emerald-400 bg-slate-800/80 rounded-xl border border-slate-700/60 transition">
                        <i class="fa-solid fa-cart-shopping text-lg"></i>
                        <span id="cart-count" class="absolute -top-1.5 -right-1.5 bg-emerald-500 text-slate-950 text-xs font-black rounded-full w-5 h-5 flex items-center justify-center shadow-md">0</span>
                    </button>
                    <a href="#" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-slate-950 font-bold px-5 py-2.5 rounded-xl transition duration-300 shadow-lg shadow-emerald-500/25 flex items-center space-x-2 text-sm">
                        <i class="fa-solid fa-user"></i>
                        <span>Masuk</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-20 md:pt-40 md:pb-32 bg-gradient-to-b from-slate-900 via-slate-950 to-slate-950 overflow-hidden">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-96 h-96 bg-emerald-500/15 rounded-full blur-[120px] -z-0"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6 text-center md:text-left">
                    <div class="inline-flex items-center space-x-2 bg-emerald-500/10 text-emerald-400 text-xs font-bold px-4 py-2 rounded-full border border-emerald-500/20">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>KOLEKSI TERBARU 2026</span>
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight tracking-tight">
                        Kuasai Lapangan <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400">Dengan Perlengkapan Terbaik!</span>
                    </h1>
                    <p class="text-slate-400 text-base sm:text-lg leading-relaxed max-w-xl">
                        Dapatkan sepatu bola original, jersey klub favorit, bola resmi standar FIFA, dan perlengkapan futsal terlengkap dengan garansi 100% original.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 justify-center md:justify-start pt-2">
                        <a href="#produk" class="bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold px-8 py-4 rounded-xl transition duration-300 shadow-lg shadow-emerald-500/30 flex items-center justify-center space-x-3">
                            <span>Belanja Sekarang</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="#kategori" class="bg-slate-900 border border-slate-700 hover:border-emerald-500 text-slate-200 font-semibold px-6 py-4 rounded-xl transition duration-300 flex items-center justify-center">
                            Lihat Katalog
                        </a>
                    </div>
                </div>

                <!-- Hero Card Mockup -->
                <div class="relative flex justify-center">
                    <div class="w-full max-w-md bg-slate-900/90 border border-slate-800 p-6 rounded-3xl shadow-2xl backdrop-blur-xl relative">
                        <span class="absolute top-4 left-4 bg-emerald-500 text-slate-950 font-extrabold text-[11px] px-3 py-1 rounded-full uppercase tracking-wider">HOT ITEM</span>
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=700&q=80" alt="Nike Mercurial" class="w-full h-64 object-cover rounded-2xl mb-5 shadow-lg">
                        <div class="space-y-2">
                            <div class="flex justify-between items-center text-xs text-slate-400">
                                <span class="text-emerald-400 font-medium">Sepatu Bola Original</span>
                                <span><i class="fa-solid fa-star text-amber-400"></i> 4.9 (240 Ulasan)</span>
                            </div>
                            <h3 class="text-xl font-bold text-white">Nike Air Zoom Mercurial Vapor</h3>
                            <p class="text-slate-400 text-xs">Desain aerodinamis untuk kecepatan maksimal di lapangan sintetis & rumput alami.</p>
                            <div class="flex justify-between items-center pt-3 border-t border-slate-800">
                                <div>
                                    <span class="text-xs text-slate-500 line-through">Rp 2.999.000</span>
                                    <p class="text-emerald-400 font-black text-2xl">Rp 2.499.000</p>
                                </div>
                                <button onclick="addToCart('Nike Air Zoom Mercurial')" class="bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold px-5 py-2.5 rounded-xl transition text-sm flex items-center space-x-2">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                    <span>Beli</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TRUST BADGES -->
    <section class="py-8 bg-slate-900 border-y border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="p-4 flex items-center justify-center space-x-3">
                    <i class="fa-solid fa-shield-halved text-2xl text-emerald-400"></i>
                    <div class="text-left">
                        <h4 class="font-bold text-sm">100% Original</h4>
                        <p class="text-xs text-slate-400">Garansi uang kembali</p>
                    </div>
                </div>
                <div class="p-4 flex items-center justify-center space-x-3">
                    <i class="fa-solid fa-truck-fast text-2xl text-emerald-400"></i>
                    <div class="text-left">
                        <h4 class="font-bold text-sm">Pengiriman Cepat</h4>
                        <p class="text-xs text-slate-400">Ke seluruh Indonesia</p>
                    </div>
                </div>
                <div class="p-4 flex items-center justify-center space-x-3">
                    <i class="fa-solid fa-tags text-2xl text-emerald-400"></i>
                    <div class="text-left">
                        <h4 class="font-bold text-sm">Harga Terbaik</h4>
                        <p class="text-xs text-slate-400">Diskon member harian</p>
                    </div>
                </div>
                <div class="p-4 flex items-center justify-center space-x-3">
                    <i class="fa-solid fa-headset text-2xl text-emerald-400"></i>
                    <div class="text-left">
                        <h4 class="font-bold text-sm">Layanan 24/7</h4>
                        <p class="text-xs text-slate-400">CS ramah & responsive</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KATEGORI PRODUK -->
    <section id="kategori" class="py-20 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-xl mx-auto mb-14">
                <h2 class="text-3xl font-extrabold text-white">Kategori Pilihan</h2>
                <p class="text-slate-400 mt-2 text-sm">Cari perlengkapan olahraga impianmu sesuai kebutuhan</p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Kategori Card 1 -->
                <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800 hover:border-emerald-500/50 transition duration-300 text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-500 group-hover:text-slate-950 transition duration-300">
                        <i class="fa-solid fa-shoe-prints text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white">Sepatu Bola & Futsal</h3>
                    <p class="text-xs text-slate-400 mt-1">150+ Produk</p>
                </div>

                <!-- Kategori Card 2 -->
                <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800 hover:border-emerald-500/50 transition duration-300 text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-500 group-hover:text-slate-950 transition duration-300">
                        <i class="fa-solid fa-shirt text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white">Jersey Original</h3>
                    <p class="text-xs text-slate-400 mt-1">90+ Produk</p>
                </div>

                <!-- Kategori Card 3 -->
                <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800 hover:border-emerald-500/50 transition duration-300 text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-500 group-hover:text-slate-950 transition duration-300">
                        <i class="fa-solid fa-futbol text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white">Bola Resmi FIFA</h3>
                    <p class="text-xs text-slate-400 mt-1">40+ Produk</p>
                </div>

                <!-- Kategori Card 4 -->
                <div class="bg-slate-900 p-6 rounded-2xl border border-slate-800 hover:border-emerald-500/50 transition duration-300 text-center group cursor-pointer">
                    <div class="w-16 h-16 bg-emerald-500/10 text-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-500 group-hover:text-slate-950 transition duration-300">
                        <i class="fa-solid fa-shield-halved text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white">Sarung Tangan & Deper</h3>
                    <p class="text-xs text-slate-400 mt-1">60+ Produk</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KATALOG PRODUK POPULER -->
    <section id="produk" class="py-20 bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12">
                <div>
                    <span class="text-emerald-400 text-xs font-bold uppercase tracking-wider">REKOMENDASI TERBAIK</span>
                    <h2 class="text-3xl font-extrabold text-white mt-1">Katalog Produk Populer</h2>
                </div>
                <a href="#" class="mt-4 md:mt-0 text-emerald-400 font-semibold hover:text-emerald-300 text-sm flex items-center space-x-2">
                    <span>Lihat Semua Produk</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <!-- Grid Produk -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Product 1 -->
                <div class="bg-slate-950 rounded-2xl overflow-hidden border border-slate-800 hover:border-emerald-500/50 transition duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="relative overflow-hidden">
                            <span class="absolute top-3 left-3 bg-emerald-500 text-slate-950 text-[10px] font-black px-2.5 py-1 rounded-md uppercase z-10">DISKON 15%</span>
                            <img src="https://images.unsplash.com/photo-1511886929837-354d827aae26?auto=format&fit=crop&w=600&q=80" alt="Adidas Predator" class="w-full h-52 object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-6">
                            <span class="text-xs text-emerald-400 font-medium">Adidas</span>
                            <h3 class="font-bold text-lg text-white mt-1 group-hover:text-emerald-400 transition">Adidas Predator Accuracy FG</h3>
                            <p class="text-slate-400 text-xs mt-2 line-clamp-2">Sepatu bola kontrol presisi dengan teknologi Demonskin untuk grip bola maksimal.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 flex items-center justify-between border-t border-slate-900">
                        <div>
                            <span class="text-xs text-slate-500 line-through">Rp 2.800.000</span>
                            <p class="text-lg font-black text-white">Rp 2.380.000</p>
                        </div>
                        <button onclick="addToCart('Adidas Predator Accuracy')" class="bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-slate-950 p-3 rounded-xl transition duration-300">
                            <i class="fa-solid fa-cart-plus text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-slate-950 rounded-2xl overflow-hidden border border-slate-800 hover:border-emerald-500/50 transition duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="relative overflow-hidden">
                            <span class="absolute top-3 left-3 bg-cyan-500 text-slate-950 text-[10px] font-black px-2.5 py-1 rounded-md uppercase z-10">NEW ARRIVAL</span>
                            <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?auto=format&fit=crop&w=600&q=80" alt="Puma Future" class="w-full h-52 object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-6">
                            <span class="text-xs text-emerald-400 font-medium">Puma</span>
                            <h3 class="font-bold text-lg text-white mt-1 group-hover:text-emerald-400 transition">Puma Future Ultimate FG</h3>
                            <p class="text-slate-400 text-xs mt-2 line-clamp-2">Fleksibilitas tinggi dengan teknologi FUSIONFIT+ untuk pergerakan lincah.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 flex items-center justify-between border-t border-slate-900">
                        <div>
                            <span class="text-xs text-slate-500 line-through">Rp 2.500.000</span>
                            <p class="text-lg font-black text-white">Rp 2.199.000</p>
                        </div>
                        <button onclick="addToCart('Puma Future Ultimate')" class="bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-slate-950 p-3 rounded-xl transition duration-300">
                            <i class="fa-solid fa-cart-plus text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="bg-slate-950 rounded-2xl overflow-hidden border border-slate-800 hover:border-emerald-500/50 transition duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="relative overflow-hidden">
                            <span class="absolute top-3 left-3 bg-amber-500 text-slate-950 text-[10px] font-black px-2.5 py-1 rounded-md uppercase z-10">BEST SELLER</span>
                            <img src="https://images.unsplash.com/photo-1614632537197-38a17061c2bd?auto=format&fit=crop&w=600&q=80" alt="Bola UCL" class="w-full h-52 object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-6">
                            <span class="text-xs text-emerald-400 font-medium">Adidas Official</span>
                            <h3 class="font-bold text-lg text-white mt-1 group-hover:text-emerald-400 transition">Bola Liga Champions 2026</h3>
                            <p class="text-slate-400 text-xs mt-2 line-clamp-2">Bola pertandingan resmi UEFA Champions League dengan sertifikasi FIFA Quality Pro.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 flex items-center justify-between border-t border-slate-900">
                        <div>
                            <span class="text-xs text-slate-500 line-through">Rp 1.800.000</span>
                            <p class="text-lg font-black text-white">Rp 1.499.000</p>
                        </div>
                        <button onclick="addToCart('Bola Liga Champions')" class="bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-slate-950 p-3 rounded-xl transition duration-300">
                            <i class="fa-solid fa-cart-plus text-lg"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-950 border-t border-slate-800 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center font-bold text-slate-950">
                            <i class="fa-solid fa-futbol text-xl"></i>
                        </div>
                        <span class="font-extrabold text-xl tracking-wider text-emerald-400">TOKO<span class="text-white">BOLA</span></span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Pusat belanja perlengkapan sepak bola & futsal original terlengkap di Indonesia.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-emerald-400 transition">Beranda</a></li>
                        <li><a href="#kategori" class="hover:text-emerald-400 transition">Kategori</a></li>
                        <li><a href="#produk" class="hover:text-emerald-400 transition">Produk Populer</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-emerald-400 transition">Cara Pembelian</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Cek Resi</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Panduan Ukuran Sepatu</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4">Hubungi Kami</h4>
                    <p class="text-sm text-slate-400 mb-2"><i class="fa-brands fa-whatsapp text-emerald-400 mr-2"></i> +62 812 3456 7890</p>
                    <p class="text-sm text-slate-400"><i class="fa-solid fa-envelope text-emerald-400 mr-2"></i> cs@tokobola.com</p>
                </div>
            </div>
            <div class="border-t border-slate-900 pt-8 text-center text-xs text-slate-500">
                <p>&copy; 2026 Toko Bola Laravel. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JS TOAST NOTIFICATION -->
    <div id="toast" class="fixed bottom-6 right-6 bg-emerald-500 text-slate-950 font-bold px-5 py-3 rounded-xl shadow-2xl hidden items-center space-x-3 z-50 transition duration-300">
        <i class="fa-solid fa-circle-check text-xl"></i>
        <span id="toast-message">Produk berhasil ditambahkan!</span>
    </div>

    <script>
        let count = 0;
        function addToCart(productName) {
            count++;
            document.getElementById('cart-count').innerText = count;
            
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').innerText = productName + ' masuk ke keranjang!';
            toast.classList.remove('hidden');
            toast.classList.add('flex');
            
            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('flex');
            }, 3000);
        }
    </script>
</body>
</html>