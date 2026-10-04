<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $outOfStock = Product::where('stock', 0)->count();

        return view('dashboard', compact('totalProducts', 'activeProducts', 'outOfStock'));
    }
}