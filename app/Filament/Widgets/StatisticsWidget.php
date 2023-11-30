<?php

namespace App\Filament\Widgets;

use App\Services\AdminService;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatisticsWidget extends BaseWidget
{

    protected function getStats(): array
    {
        $states = array();

        if(! AdminService::can('see statistics')){
            $states = [
                Stat::make('Cats', 1)->icon('heroicon-o-users'),
                Stat::make('Dogs', 2),
                Stat::make('Rabbits', 3),
            ];
        }

        return $states;
    }
}
