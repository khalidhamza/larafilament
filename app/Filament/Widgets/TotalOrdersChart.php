<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class TotalOrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Total Orders';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Total Orders',
                    'data'  => [65, 59, 80, 81, 56, 55, 40],
                ]
            ],
            'labels' => ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
