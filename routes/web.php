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

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('frontend');
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
            $request->session()->regenerate();
            return redirect()->intended('/kasir');
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
        return redirect('/kasir');
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
        return redirect('/kasir');
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

// Akses Khusus Admin
Route::middleware(['role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin', function () {
        return redirect()->route('products.index');
    });
    Route::resource('products', ProductController::class);
});

// Akses Gabungan (Admin & Kasir)
Route::middleware(['role:admin,kasir'])->group(function () {
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::post('/kasir/transaksi', [KasirController::class, 'store'])->name('kasir.store');
});