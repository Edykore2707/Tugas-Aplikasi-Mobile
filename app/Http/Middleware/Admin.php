<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Jika BELUM login ATAU role user BUKAN 'admin', LANGSUNG tendang ke /login
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        // 2. Jika SUDAH login dan role 'admin', izinkan lewat
        return $next($request);
    }
}