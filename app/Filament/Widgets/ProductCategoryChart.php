<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class ProductCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Produk per Kategori';

    protected function getData(): array
    {
        $categories = Category::withCount('products')->orderBy('name')->get();

        return [
            'datasets' => [[
                'label' => 'Jumlah Produk',
                'data' => $categories->pluck('products_count')->toArray(),
                'backgroundColor' => '#f59e0b',
                'borderColor' => '#d97706',
            ]],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
