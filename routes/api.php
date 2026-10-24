<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes (Toko Bola - Sanctum Token Authentication)
|--------------------------------------------------------------------------
*/

// Endpoint Register API untuk Membuat User Baru
Route::post('/register', function (Request $request) {
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => 'user',
    ]);

    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
        'message'      => 'Register API Berhasil',
        'access_token' => $token,
        'token_type'   => 'Bearer',
        'user'         => $user,
    ], 201);
});

// Endpoint Login API (Menggunakan AuthController)
Route::post('/login', [AuthController::class, 'login']);

// Endpoint API Terproteksi Menggunakan Sanctum Guard
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Endpoint Logout API
    Route::post('/logout', [AuthController::class, 'logout']);
});

// CRUD API Buku (Publik / Bebas Akses Tanpa Token)
Route::apiResource('books', BookController::class);

// Endpoint Cetak Struk Buku ke Printer Thermal
Route::post('books/{id}/print', [BookController::class, 'print']);