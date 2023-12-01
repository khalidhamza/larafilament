<?php

namespace App\Filament\Widgets;

use App\Traits\WidgetPermissions;
use Filament\Widgets\ChartWidget;

class SalesValueChart extends ChartWidget
{
    use WidgetPermissions;

    protected static ?string $heading = 'Sales Value';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan  = 1;
    
    protected static string $permissionName = 'sales value chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Sales Value',
                    'data'  => [65, 59, 80, 81, 56, 55, 40],
                ]
            ],
            'labels' => ['A', 'B', 'C', 'D', 'E', 'F', 'G'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
