<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StrukController; // <-- Ditambahkan

/*
|--------------------------------------------------------------------------
| Halaman Publik / Akses Awal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Rute Akses Tamu / Guest (Belum Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    // Halaman & Proses Login Standar
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::id());

            if ($user && empty($user->role)) {
                $user->role = str_contains(strtolower((string) $user->email), 'admin') ? 'admin' : 'kasir';
                $user->save();
            }

            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    });

    // Halaman & Proses Registrasi Pengguna Baru
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kasir', // Role default pendaftaran
        ]);

        Auth::login($user);
        return redirect('/dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| Fitur Verifikasi Email, Logout, & Modul Authorization (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Rute Profile (Menyelesaikan error Route profile.edit not defined)
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

    // Halaman Pemberitahuan Verifikasi Email
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // Link Eksekusi Verifikasi Email
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware(['signed'])->name('verification.verify');

    // Kirim Ulang Email Verifikasi
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi baru telah dikirim!');
    })->middleware(['throttle:6,1'])->name('verification.send');

    // Logout
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

    // Rute Modul Authorization (Gate & Policy)
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])
        ->middleware('can:update,post');
    Route::resource('posts', PostController::class);
});

/*
|--------------------------------------------------------------------------
| Area Terproteksi Middleware Role (RBAC Toko Bola)
|--------------------------------------------------------------------------
*/

// Akses yang harus login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');

    // Akses gabungan (Admin & Kasir)
    Route::middleware(['role:admin,kasir'])->group(function () {
        Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
        Route::post('/kasir/transaksi', [KasirController::class, 'store'])->name('kasir.store');

        // Rute Cetak Struk
        Route::get('/struk', [StrukController::class, 'struk'])->name('struk.cetak');
    });

    // Produk hanya admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('products', ProductController::class);
    });
});