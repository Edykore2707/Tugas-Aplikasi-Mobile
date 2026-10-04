<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes (Toko Bola - Sanctum Token Authentication)
|--------------------------------------------------------------------------
*/

// Endpoint Login API untuk Generate Token Sanctum
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Unauthorized / Email atau Password Salah'
        ], 401);
    }

    // Pembuatan Token Sanctum
    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
        'message' => 'Login API Berhasil',
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ]);
});

// Endpoint API Terproteksi Menggunakan Sanctum Guard
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});