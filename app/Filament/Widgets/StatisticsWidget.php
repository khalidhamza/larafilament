<?php

namespace App\Filament\Widgets;

use App\Services\AdminService;
use App\Traits\WidgetPermissions;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatisticsWidget extends BaseWidget
{
    use WidgetPermissions;
    
    protected static ?int $sort = 1;

    protected static string $permissionName = 'statistics';

    protected function getStats(): array
    {
        $states = array();

        if(! AdminService::can('see statistics')){
            $states = [
                Stat::make('Cats', 1)
                    ->chart([1, 2, 30, 1])
                    ->icon('heroicon-o-users'),
                Stat::make('Dogs', 2),
                Stat::make('Rabbits', 3),
            ];
        }

        return $states;
    }
}
