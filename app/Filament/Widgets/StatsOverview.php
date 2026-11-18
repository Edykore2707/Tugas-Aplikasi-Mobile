<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $lowStock = Product::query()->where('stock', '<=', 5)->where('is_active', true)->count();

        return [
            Stat::make('Total Produk', Product::count())
                ->description('Produk terdaftar')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('primary'),
            Stat::make('Total Kategori', Category::count())
                ->description('Kategori aktif')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
            Stat::make('Stok Hampir Habis', $lowStock)
                ->description('Stok ≤ 5 unit')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($lowStock > 0 ? 'danger' : 'success'),
            Stat::make('Transaksi Selesai', Transaction::where('status', 'completed')->count())
                ->description('Semua transaksi berhasil')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),
        ];
    }
}
