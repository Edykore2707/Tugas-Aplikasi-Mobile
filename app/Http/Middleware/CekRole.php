<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CekRole
{
    /**
     * Handle request dengan Parameter Role (Poin 5 Modul)
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Jika belum login, redirect ke halaman login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role pengguna ada di dalam parameter $roles
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // 3. Jika role tidak cocok, kembalikan pesan Akses Ditolak (HTTP 403)
        return response()->json([
            'message' => 'Akses ditolak! Anda tidak memiliki izin ke halaman ini.'
        ], 403);
    }

    /**
     * Terminate Method untuk Logging setelah Request selesai (Poin 6 Modul)
     */
    public function terminate($request, $response)
    {
        if (Auth::check()) {
            Log::info('Aktivitas Toko Bola:', [
                'user_id' => Auth::id(),
                'email'   => Auth::user()->email,
                'role'    => Auth::user()->role,
                'url'     => $request->fullUrl(),
                'ip'      => $request->ip()
            ]);
        }
    }
}